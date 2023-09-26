# ++++++++++++++++++
# | Tarusi Mittal  |
# | 1901CS65       |
# ++++++++++++++++++

# +++++++++++++++
# | Question 1  |
# +++++++++++++++

Compilation: g++ P1.cpp -o P1
Syntax: ./P1
{No of process(n)}
{arrival time} {burst time}
.
.
.
n times

In this we us ethe principle of first come first serve
In this the process which has the least arrival time is completed first.
It uses non premitive mode to sort

# Examples of execution:

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/Lab-6$ g++ P1.cpp -o P1
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/Lab-6$ ./P1
Write the no of processes(n): 3
0 5
1 7
3 4
4.33 9.67
P1 P2 P3

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/Lab-6$ ./P1
Write the no of processes(n): 5
1 3
1 2
4 7
3 6
2 6
6.00 10.80
P1 P2 P5 P4 P3

################################################################################################################

# +++++++++++++++
# | Question 2  |
# +++++++++++++++

Compilation: g++ P2.cpp -o P2
Syntax: ./P2
{No of process(n)}
{Time Quantum}
{arrival time} {burst time}
.
.
.
n times

This is the round robin process
It has a time slot or quantum and
it interrupts any job it is not completed in that interval
and the remaining job is pushed back in teh queue
Each process is served by CPU for a fixed time, so priority is the same for each one

#Examples of execution:

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/Lab-6$ g++ P2.cpp -o P2
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/Lab-6$ ./P2
Write the no of processes(n): 3
Enter the time quantum: 2
0 5
1 7
3 4
6.67 12.00
P1 P3 P2

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/Lab-6$ ./P2
Write the no of processes(n): 5
Enter the time quantum: 3
1 3
1 2
4 7
3 6
2 6
7.00 11.60
P1 P2 P5 P4 P3

###############################################################################################################

# +++++++++++++++
# | Question 3  |
# +++++++++++++++

Compilation: g++ P3.cpp -o P3
Syntax: ./P3
{No of process(n)}
{arrival time} {burst time} {priority No}
.
.
.
n times


In this algorithm, if a new process of higher priority than the
currently running process arrives,
then the currently executing process is not disturbed.
Rather, the newly arrived process is put at the head of the ready queue,
i.e. according to its priority in the queue.
And when the execution of the currently running process is complete,
 the newly arrived process will be given the CPU.

#Examples of execution:

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/Lab-6$ g++ P3.cpp -o P3
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/Lab-6$ ./P3
Write the no of processes(n): 3
0 5 1
1 7 2
3 4 3
4.33 9.67
P1 P2 P3
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/Lab-6$ ./P3
Write the no of processes(n): 4
1 3 4
1 6 2
3 2 1
3 4 3
5.50 9.25
P2 P3 P4 P1


################################################################################################################

# +++++++++++++++
# | Question 4  |
# +++++++++++++++

Compilation: g++ P4.cpp -o P4
Syntax: ./P4
{No of process(n)}
{arrival time} {burst time}
.
.
.
n times


In the highest Remaining time first
the job which has the highest execution time id=s doen first
It uses a preemptive mode to perform teh tasks
The task is executed for a given time quantum and then
It is pushed back into the queue If teh time remains

# Examples of execution:

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/Lab-6$ g++ P4.cpp -o P4
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/Lab-6$ ./P4
Write the no of processes(n): 3
0 5
1 7
3 4
8.33 13.67
P1 P2 P3

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/Lab-6$ ./P4
Write the no of processes(n): 5
1 3
1 2
4 7
3 6
2 6
16.00 20.80
P1 P2 P3 P4 P5


############################################## END #################################################################
