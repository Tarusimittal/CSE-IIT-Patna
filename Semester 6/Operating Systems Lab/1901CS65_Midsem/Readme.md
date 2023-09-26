# ++++++++++++++++++
# | Tarusi Mittal  |
# | 1901CS65       |
# | MidSemester    |
# ++++++++++++++++++

# +++++++++++++++
# | Question 1  |
# +++++++++++++++

Compilation: cd Ques1
            gcc P1.c -o P1
Syntax: ./P1

`For this question first we have to enter the Ques1 directory
In that we we have two file initially.
We are reading from the file named readFileForQ1.
then when we run our program
New file like 1.txt, 2.txt until 6.txt are formed
because we have 6 lines in out readFileForq1.c.`

# Examples of execution:

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65_midsem$ cd Ques1
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65_midsem/Ques1$ gcc P1.c -o P1
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65_midsem/Ques1$ ./P1
The file readFileForQ1.c has 6 lines
I am Child 1: and I wrote line number:1 in the file 1.txt!
I am Child 2: and I wrote line number:2 in the file 2.txt!
I am Child 3: and I wrote line number:3 in the file 3.txt!
I am Child 4: and I wrote line number:4 in the file 4.txt!
I am Child 5: and I wrote line number:5 in the file 5.txt!
I am Child 6: and I wrote line number:6 in the file 6.txt!

################################################################################################################

# +++++++++++++++
# | Question 2  |
# +++++++++++++++

Compilation: cd Ques2
            gcc child.cpp -o child
            gcc parent.cpp -o parent
Syntax: ./parent {gender} {name} {gender} {name} {gender} {name}..... any no of times


`For this question first we have to enter the Ques2 directory`

#Examples of execution:

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65_midsem$ cd Ques2
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65_midsem/Ques2$ gcc child.c -o child
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65_midsem/Ques2$ gcc parent.c -o parent
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65_midsem/Ques2$ ./parent girl nancy boy mark boy joseph
There are a total of 3 children.
Child #1: I am a girl, and my name is nancy
Child #2: I am a boy, and my name is mark
Child #3: I am a boy, and my name is joseph
All child processes terminated. Parent exits

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65_midsem/Ques2$ ./parent girl taru boy tejas girl tipi
There are a total of 3 children.
Child #1: I am a girl, and my name is taru
Child #2: I am a boy, and my name is tejas
Child #3: I am a girl, and my name is tipi
All child processes terminated. Parent exits

###############################################################################################################

# +++++++++++++++
# | Question 3  |
# +++++++++++++++

Compilation: cd Ques3
             g++ P3.cpp -o P3
Syntax: ./P3
{No of process(n)} {No of Queues}
{Arrival Time} {Burst Time} {Priority No}
.
.
.
n times


`For this question first we have to enter the Ques3 directory`

`A multi-level queue scheduling algorithm partitions the ready queue into several separate queues.
The processes are permanently assigned to one queue,
generally based on some property of the process,
such as memory size, process priority, or process type.
Each queue has its own scheduling algorithm.
if there are no processes on the higher priority queue
only then the processes on the low priority queues will be executed.`

# Method : Not specified in question so took Non Pre-emptive  

#Examples of execution:

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65_midsem$ cd Ques3
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65_midsem/Ques3$ g++ P3.cpp -o P3
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65_midsem/Ques3$ ./P3
5 2
0 10 2
3 7 1
4 6 2
12 5 1
18 8 1
Avg_WT = 10.40 Avg_TAT = 17.60
P2 P4 P5 P3 P1


################################################################################################################

# +++++++++++++++
# | Question 4  |
# +++++++++++++++


Compilation: gcc -o P4 P4.c -lpthread
Syntax: ./P4

`Go to folder Ques4`

# Examples of execution:

tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/1901CS65_midsem/Ques4$ ./P4
Enter amount: 102
Amount = 102, borrowed.
Total Amount Left = 398
Enter amount: 30
Amount = 30, borrowed.
Total Amount Left = 368
Enter amount: 28
Amount = 28, borrowed.
Total Amount Left = 340
Enter amount: 100
Amount = 100, borrowed.
Total Amount Left = 240
Enter amount: 50
Amount = 50, borrowed.
Total Amount Left = 190
Enter amount: 20
Amount = 20, borrowed.
Total Amount Left = 170
Enter amount: 50
Amount = 50, borrowed.
Total Amount Left = 120
Enter amount: 20
Amount = 20, borrowed.
Total Amount Left = 100
Enter amount: 10
Amount = 10, borrowed.
Total Amount Left = 90
Enter amount: 50
Amount = 50, borrowed.
Total Amount Left = 40
Enter amount: 30
Amount = 30, borrowed.
Total Amount Left = 10
Enter amount: 10
Amount = 10, borrowed.
Total Amount Left = 0
Enter amount: 0
Amount = 0, borrowed.
Total Amount Left = 0
Enter amount: 10
Hacked 0 amount from you.
Amount = 10, deposited.
Total Amount Left= 10


############################################## END #################################################################
