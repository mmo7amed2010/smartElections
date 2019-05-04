# Smart Elections
This project scans any Egyptian national id by getting its national id number into text format to help the user to identify if the people allowed to vote, already voted, or unable to vote. this process is done by comparing the id number with DB records.
## Database
![enter image description here](https://i.ibb.co/LYG67Y6/Untitled.png)
as we see in the image we have a table that contains the users allowed to vote and their statuses, if the status is "yes", means that the user already elected if "no" means that the user not elected yet. the "no" will change into "yes" automatically when user national id is scanned.
**Note** : the DB is attached with name ip.sql
## python opencv code
the python code is in the directory public/beta2a/y.py [click here to see the code with comments](https://github.com/mmo7amed2010/smartElections/blob/master/public/beta2a/y.py).for jupyter pdf click [here](https://ufile.io/1cr461v0)
## OCR Using tesseract
the tesseract-ocr run by shell execution handled by PHP code in the directory app/Http/Controllers/HomeController.php [click here to see the code ](https://github.com/mmo7amed2010/smartElections/blob/master/app/Http/Controllers/HomeController.php).

 **the ocr is running in this line of code using non offical trained tessdata**:

    $id_no = shell_exec('"C:\Program Files (x86)\Tesseract-OCR\tesseract.exe" '.$id_no.' E:/ip/public/'.$name.' -l ara-Amiri-layer 2>&1');

## video
here is a video demonestrates how it works [click here](https://www.youtube.com/watch?v=T7oyJq11G7Y)
