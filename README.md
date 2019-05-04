# Smart Elections
## Contributors
- Mohamed Gamal Abbass
- Mo'men Mamdouh Helmy
- Mohamed Elsayed Abdelfattah
- Mohamed Sayed Ali
- Mohamed Shaden Ibrahim
## Description
Recently as a part of trying to grow into a more democratic environment, participation in election is obviously increasing.
The integrity and simplicity of the process always remain as big threatening issues due to the traditional ways used to manage the election process starting from the eligibility of the person to participate, taking his fingerprint, and whether he had already voted or not.  
Our Project aims to resolve these issues through scanning any Egyptian national ID and extracting the information needed and comparing them with the information already stored in the election process database to help the user identify if the ID's holder allowed to vote, already voted, or unable to vote in a very short time.
## Implementation
### Part1: Building the database.
• Gathering information about the election criteria and names allowed to participate.  
• Adding the information into a well-designed database. 
![enter image description here](https://i.ibb.co/LYG67Y6/Untitled.png)  
The table contains the users allowed to vote and their status.  
"yes", means that the user already voted, while "no" means that the user has not voted yet.  
The "no" status will change into "yes" automatically when the user national ID is scanned.  
**Note** : the DB is attached with name ip.sql
### Part2: Image pre-processing using python opencv.  
• Finding contours in the image to get the boundaries.
• Applying Perspective Transformation.
• Removing noise from the image and apply binarization.
the python code is in the directory public/beta2a/y.py [click here to see the code with comments](https://github.com/mmo7amed2010/smartElections/blob/master/public/beta2a/y.py).for jupyter pdf click [here](https://ufile.io/1cr461v0)
## OCR Using tesseract
the tesseract-ocr run by shell execution handled by PHP code in the directory app/Http/Controllers/HomeController.php [click here to see the code ](https://github.com/mmo7amed2010/smartElections/blob/master/app/Http/Controllers/HomeController.php).

 **the ocr is running in this line of code using non offical trained tessdata**:

    $id_no = shell_exec('"C:\Program Files (x86)\Tesseract-OCR\tesseract.exe" '.$id_no.' E:/ip/public/'.$name.' -l ara-Amiri-layer 2>&1');

### video
here is a video demonestrates how it works [click here](https://www.youtube.com/watch?v=T7oyJq11G7Y)
