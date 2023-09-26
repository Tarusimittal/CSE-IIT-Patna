# ++++++++++++++++++
# | Tarusi Mittal  |
# | 1901CS65       |
# | LAB 7          |
# ++++++++++++++++++

# +++++++++++++++
# | Question 1  |
# +++++++++++++++

Compilation: gcc -o q1 q1.c -lm -pthread -fopenmp
Syntax: ./q1

`When database is shared among various processes
some of the processes just want to read where as
the others should want to write.
Now multiple readers can read at the same time but if even one writer
is writing into the file it might change for other writers or the other reader
which might result in the data inconsistency this is the readers writers problem`

We have used semaphores and mutex to solve this problem

# Examples of execution:

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901Cs65_Lab7$ gcc -o q1 q1.c -lm -pthread -fopenmp
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901Cs65_Lab7$ ./q1
Writer 1 is writing in the file
Reader 1: read count as 1
Writer 2 is writing in the file
Reader 2: read count as 1
Reader 3: read count as 1
Reader 5: read count as 2
Reader 4: read count as 2

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901Cs65_Lab7$ ./q1
Writer 1 is writing in the file
Writer 2 is writing in the file
Reader 1: read count as 1
Reader 3: read count as 3
Reader 2: read count as 2
Reader 4: read count as 1
Reader 5: read count as 1

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901Cs65_Lab7$ ./q1
Writer 1 is writing in the file
Writer 2 is writing in the file
Reader 1: read count as 1
Reader 2: read count as 1
Reader 3: read count as 1
Reader 4: read count as 1
Reader 5: read count as 1

################################################################################################################

# +++++++++++++++
# | Question 2  |
# +++++++++++++++

Compilation: gcc -o q2 q2.c -lm -pthread -fopenmp
Syntax: ./q2

`Sequence to end u in deadlock
1. In our question
-> We first assume that A starts running then it will wait for mutex
-> And will siwtch to B so cointext switching takes place
-> but B will now wait for data until the semaphore-mutex is free
-> which implies that we have entered a deadlock

2. In our Question
-> deadlock is impossible`


#Examples of execution:

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901Cs65_Lab7$ gcc -o q2 q2.c -lm -pthread -fopenmp
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901Cs65_Lab7$ ./q2
process A
process B

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901Cs65_Lab7$ ./q2
process B
process A

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901Cs65_Lab7$ ./q2
process A
process B

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901Cs65_Lab7$ ./q2
process A
process B

###############################################################################################################

# +++++++++++++++
# | Question 3  |
# +++++++++++++++

Compilation: gcc -o q3 q3.c -lm -pthread -fopenmp
Syntax: ./q3


`As it is a endless loop we will physically have to
Abort the function otherwise it will keep on running
Beacuse according to the question whenever
a pizza is finished a new pizza is being ordered`

#Examples of execution:

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901Cs65_Lab7$ gcc -o q3 q3.c -lm -pthread -fopenmp
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901Cs65_Lab7$ ./q3
|---------Hey! Pizza Delivery--------|
Student no 1 is eating and studying
Only 4 / 5 remaining
Student no 3 is eating and studying
Only 3 / 5 remaining
Student no 2 is eating and studying
Only 2 / 5 remaining
Student no 4 is eating and studying
Only 1 / 5 remaining
Student no 5 is eating and studying
Only 0 / 5 remaining
|---------Hey! Pizza Delivery--------|
Student no 6 is eating and studying
Only 4 / 5 remaining
Student no 1 is eating and studying
Only 3 / 5 remaining
Student no 3 is eating and studying
Only 2 / 5 remaining
Student no 2 is eating and studying
Only 1 / 5 remaining
Student no 7 is eating and studying
Only 0 / 5 remaining
|---------Hey! Pizza Delivery--------|
Student no 8 is eating and studying
Only 4 / 5 remaining
Student no 6 is eating and studying
Only 3 / 5 remaining
Student no 1 is eating and studying
Only 2 / 5 remaining
Student no 3 is eating and studying
Only 1 / 5 remaining
Student no 4 is eating and studying
Only 0 / 5 remaining
|---------Hey! Pizza Delivery--------|
Student no 5 is eating and studying
Only 4 / 5 remaining
Student no 6 is eating and studying
Only 3 / 5 remaining
Student no 1 is eating and studying
Only 2 / 5 remaining
Student no 7 is eating and studying
Only 1 / 5 remaining
Student no 2 is eating and studying
Only 0 / 5 remaining
|---------Hey! Pizza Delivery--------|
Student no 8 is eating and studying
Only 4 / 5 remaining
Student no 5 is eating and studying
Only 3 / 5 remaining
Student no 6 is eating and studying
Only 2 / 5 remaining
Student no 1 is eating and studying
Only 1 / 5 remaining
Student no 3 is eating and studying
Only 0 / 5 remaining
|---------Hey! Pizza Delivery--------|
Student no 4 is eating and studying
Only 4 / 5 remaining
Student no 8 is eating and studying
Only 3 / 5 remaining
^C
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901Cs65_Lab7$





############################################## END #################################################################
