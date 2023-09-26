------------------------------------------------------------------------------------------

Running on Ubunutu environment:

Problem 1:

sh q1.sh
Output: Error: Zero arguments passed

sh q1.sh 1 2 5
Output: Error: More than one arguments passed.

sh q1.sh 758
Output: 857

sh q1.sh 100
Output: 1

sh q1.sh -28
Output: -82


------------------------------------------------------------------------------------------

Problem 2:

sh q2.sh
Input:
2
8
Output:
2 3 4 5 6 7 8

sh q2.sh
Input:
5
5
Output:
5

sh q2.sh
Input:
25
15
Output:
Error: Wrong Range given.

------------------------------------------------------------------------------------------

Problem 3:

sh q3.sh test.txt
Output: 
Error: Please pass both the arguments correctly.

sh q3.sh test.txt 5
Output:
Number of lines in file: 7

sh q3.sh test.txt 10
Output:
Number of lines in file: 7
Deleting the file.


------------------------------------------------------------------------------------------

Problem 4:

sh q4.sh 
Input:
Enter directory_path: /home/tarusimittal/Desktop/newfolder
Enter filename_pattern: pqr
Enter the new_filename: art

Filenames having subsequences pqr will be changed to art_1, art_2 and so on.

------------------------------------------------------------------------------------------