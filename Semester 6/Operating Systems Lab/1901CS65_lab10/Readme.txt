Tarusi Mittal
1901CS65
Assignemnt 10

Running the c++ code:

Note: I have taken two extra inputs in the first line for the ease of implementation

Input format:
p,v,f,n,q      -> q is the no of queries
2*n integers   -> range block
q1
.
.
.
.
qi                


compilation:
g++ -o -Q1 Q1.cpp

Syntax:
./Q1
p,v,f,n,q      -> q is the no of queries
2*n integers   -> range block
q1
.
.
.
.
qi  


Example input output:
Input:
7 10 2 2 7
0 2 5 7
a 64
d 3
d 5
t 43
a 32
t 26
d 1

Output:
64 bytes has been allocated in frame no:3 4 8 9 10 11 12 13 14 15 16 17 18 19 20 21 
Page number 3 has been deleted and frame 9 is now empty
Page number 5 has been deleted and frame 11 is now empty
The physical address is:67
32 bytes has been allocated in frame no:9 11 22 23 24 25 26 27 
The physical address is:50
Page number 1 has been deleted and frame 4 is now empty



