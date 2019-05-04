# import the necessary packages
import numpy as np
import cv2
import argparse
import imutils

#arguments parser
def create_parser():
	parser = argparse.ArgumentParser(description="Recognize a file via web service")
	parser.add_argument('camera_image')
	parser.add_argument('source_file')
	return parser

args = create_parser().parse_args()
camera_image= args.camera_image
source_file = args.source_file

# # load the image, resize it , and take resize ration
image = cv2.imread(camera_image)
ratio = image.shape[0] / 500.0
orig = image.copy()
image = imutils.resize(image, height = 500)
 
# # convert image to grayscale, blur it ,and apply canny for edges detections
gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
gray = cv2.GaussianBlur(gray, (5, 5), 0)
edged = cv2.Canny(gray, 75, 200)

#find contours and sort it by area
(cnts, _) = cv2.findContours(edged.copy(), cv2.RETR_EXTERNAL, cv2.CHAIN_APPROX_SIMPLE)
total = 0
cnts = sorted(cnts, key=cv2.contourArea)

#loop on contours from bigger areas to smaller
for c in reversed(cnts):
	# approximate the contour
	peri = cv2.arcLength(c, True)
	approx = cv2.approxPolyDP(c, 0.02 * peri, True)
	# if the approximated contour has four points, then assume that the
	# contour is a rectangle (as national id card) and thus has four vertices
	if len(approx) == 4:
		#convert the approx contours into the original image ratio (ratio) without resizing 
		points=approx.reshape(4, 2) * ratio
		points=points.astype(int)
		approx=approx.reshape(4,1, 2) * ratio
		approx=approx.astype(int)
		total += 1
		break

#draw the contours
cv2.drawContours(orig, [approx], -1, (0, 255, 0), 4)

# create empty initialized rectangle
rect = np.zeros((4, 2), dtype = "float32")
# get top left and bottom right points
s = points.sum(axis = 1)
rect[0] = points[np.argmin(s)]
rect[2] = points[np.argmax(s)]
# get top right and bottom left points
diff = np.diff(points, axis = 1)

rect[1] = points[np.argmin(diff)]
rect[3] = points[np.argmax(diff)]

(tl, tr, br, bl) = rect

widthA = np.sqrt(((br[0] - bl[0]) ** 2) + ((br[1] - bl[1]) ** 2))
widthB = np.sqrt(((tr[0] - tl[0]) ** 2) + ((tr[1] - tl[1]) ** 2))
maxWidth = max(int(widthA), int(widthB))

heightA = np.sqrt(((tr[0] - br[0]) ** 2) + ((tr[1] - br[1]) ** 2))
heightB = np.sqrt(((tl[0] - bl[0]) ** 2) + ((tl[1] - bl[1]) ** 2))
maxHeight = max(int(heightA), int(heightB))
dst = np.array([
    [0, 0],
    [maxWidth - 1, 0],
    [maxWidth - 1, maxHeight - 1],
    [0, maxHeight - 1]], dtype = "float32")
M = cv2.getPerspectiveTransform(rect, dst)
warped = cv2.warpPerspective(orig, M, (maxWidth, maxHeight))
height, width, channels = warped.shape

center = (width / 2, height / 2)
#rotate image if width < height
if width < height:
	warped = np.rot90(warped)

#resize the cutted image to a fixed ratio so we can easily get the place of the national id number
resized_image = cv2.resize(warped, (682, 429))
#cut the national id field only
image_data=resized_image[320:390,280:680]

#convert image to gray scale to prepare it for the ocr (tesseract)
image_data = cv2.cvtColor(image_data, cv2.COLOR_BGR2GRAY)
image_data = cv2.adaptiveThreshold(image_data,255,cv2.ADAPTIVE_THRESH_GAUSSIAN_C,cv2.THRESH_BINARY,19,18)
image_data = cv2.GaussianBlur(image_data, (5, 5), 0)

#write the prepared national id field image
cv2.imwrite(source_file,image_data)
#print file name to use tesseract ocr on it
print(source_file)
