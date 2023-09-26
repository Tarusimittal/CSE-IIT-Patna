# ++++++++++++++++++
# | Tarusi Mittal  |
# | 1901CS65       |
# ++++++++++++++++++

# +++++++++++++++
# | Question 1  |
# +++++++++++++++

Compilation: gcc q1.c -o q1
Syntax: ./q1 {number 1} {number 2}

# Examples of execution:

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65$ ./q1 6 24
Sum by Child 276: 30
Multiplication by Child 277: 144
Division by Parent 275: 4

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65$ ./q1 4 4
Sum by Child 279: 8
Multiplication by Child 280: 16
Division by Parent 278: 2

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65$ ./q1 4
Invalid number of arguments.

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65$ ./q1 5 4 5
Invalid number of arguments.

################################################################################################################

# +++++++++++++++
# | Question 2  |
# +++++++++++++++

Compilation: gcc q2.c -o q2
Syntax: ./q2

#Examples of execution:

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop$ gcc q2.c -o q2
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop$ ./q2
Hello   Hello   Hello   Hello   Hello   Hello   Hello   Hello  

###############################################################################################################

# +++++++++++++++
# | Question 3  |
# +++++++++++++++

# Adding permissions

To add executable permissions to the shell scripts, type the following commands:
sudo chmod a+rx task1.sh
sudo chmod a+rx task2.sh

Compilation: gcc P3.c -o P3
Syntax(TASK 1): ./task1.sh {Number of elements in array} {Array elements, space separated} {Number to be searched}
Syntax(TASK 2): ./task2.sh {Input Number}

Syntax: ./P3 {Script Name for task 1} {Task 1 arguments} {Script Name for task 2} {Task 2 arguments}

#Examples of execution:

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65$ ./q3 task1.sh 3 1 2 3 2 task2.sh 5
Element 2 found at index 2.
The required answer is : 1200

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65$ ./q3 task1.sh 5 1 2 3 4 5 3 task2.sh 6
Element 3 found at index 3.
The required answer is : 7200

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65$ ./q3 task1.sh 3 4 2 5 2 task2.sh
ERROR: execv() did not execute properly.tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65$ Element 5 found at index 3.

############################################## END #################################################################
