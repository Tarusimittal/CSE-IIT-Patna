# ++++++++++++++++++
# | Tarusi Mittal  |
# | 1901CS65       |
# | LAB 11         |
# ++++++++++++++++++

# +++++++++++++++
# | Question 1  |
# +++++++++++++++

The seek time to move one cylinder is 5 milliseconds.

### The points for plotting are stored in a txt file with the name of teh file
### Being the same as the algorithms
### We can use graphing tools to plot the graph

Compilation: g++ Q1.cpp -o Q1
Syntax: ./Q1
        {No of cyclinders}
        {Starting Position}
        {No of disk Requests}
        {Disk requests separated by space}

#Examples of execution:
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/Lab11$ g++ Q1.cpp -o Q1
tarusimittal@LAPTOP-6CRHF1GO:/mnt/c/Users/Tarusi Mittal/desktop/Lab11$ ./Q1
Enter The No of Cylinders: 200
Enter the head position: 100
Enter the number of disk requests: 5
Enter the requests separated with space: 23 89 132 42 187

FCFS Disk Scheduling
Total Head Movement = 421
Total Seek Time = 2105 ms

SCAN Disk Scheduling
Total Head Movement = 275
Total Seek Time = 1375 ms

CSCAN Disk Scheduling
Total Head Movement = 387
Total Seek Time = 1935 ms

SSTF Disk Scheduling
Total Head Movement = 273
Total Seek Time = 1365 ms

Sorted order of algorithms:
SSTF SCAN CSCAN FCFS

############################################## END #################################################################
