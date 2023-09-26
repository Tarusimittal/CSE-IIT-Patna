# Tarusi Mittakl
# 1901CS65

## Adding permissions

To add executable permissions to the shell scripts, type the following commands:

sudo chmod a+rx q1.sh
sudo chmod a+rx q2.sh
sudo chmod a+rx q3.sh
sudo chmod a+rx q4.sh

## Problem 1:
Syntax:
./q1.sh {Number of elements in array} {Array elements, space separated} {Number to be searched}

Examples of execution:

.tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65$ ./q1.sh 3 1 2 3 3
Element 3 found at index 3.
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65$ ./q1.sh 3 1 2 3 4
Element not found in the given array.
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65$ ./q1.sh 5 8 7 6 0 7 6
Element 6 found at index 3.

## Problem 2:

Syntax:
./q2.sh {Input Number}

Examples of execution:
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65$ ./q2.sh 5
The required answer is : 1200
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65$ ./q2.sh 5 3
Error: Please enter only 1 number

## Problem 3:

Syntax:
./P3.sh {Input Number 1} {Input Number 2}

Examples of execution:

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65$ ./q3.sh 5 3
The XOR of 5 and 3 is: 6
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65$ ./q3.sh 5 7
The XOR of 5 and 7 is: 2
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65$ ./q3.sh 5
Error: Invalid Input, Enter 2 numbers as arguments

### Time Analysis vs C program

#### Shell Program
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65$ time ./q3.sh 400 800
The XOR of 400 and 800 is: 688

real    0m0.012s
user    0m0.000s
sys     0m0.005s

## C programe
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65$ gcc q3.c -o q3
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65$ time ./q3 400 800
XOR Value = 688

real    0m0.005s
user    0m0.002s
sys     0m0.001s

## Problem 4:
Syntax:
./q4.sh {Password string within quotes}

Examples of execution:
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65$ ./q4.sh "trf6?"
Password Entered: trf6?
Length of Password: 5
<Invalid Password>
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65$ ./q4.sh "trf6we?"
Password Entered: trf6we?
Length of Password: 7
<Valid Password>
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65$ ./q4.sh "98jhy"
Password Entered: 98jhy
Length of Password: 5
<Invalid Password>
