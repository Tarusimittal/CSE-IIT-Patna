#!/bin/bash
# Question 3

if [ $# -ne 2 ] 
then
    echo "Error: Please pass both the arguments correctly."

else
    Name=$1
    Lines=$2
    Curr=0
    while read -r line || [ -n "$line" ]
    do
        Curr=$(($Curr + 1))
    done  < "$Name"
    
    echo "Number of lines in file: $Curr"

    if [ $Curr -lt $Lines ]
    then
        echo "Deleting the file."
        rm -f $Name
    fi
fi