#!/bin/bash
# Question 1
# NOTE: The indexing is taken to be 1-Indexing

# Arguments will be passed in the following order:
# 1-> N: No of elements in the array
# 2-> n: The N elements in the array
# 3-> S: The element we need to search in the array

# First we store the command line arguments in the array
# $@ takes the whole arguments input
# $1 stores the first argument  which means the length of the array
# 2:$1 stores the array into an array named smp 
# string:startposition:length to substring where@ is string 2 the start position and length in $1

smp=(${@:2:$(($1))})

# The element to be searched is present as the last argument
# and we store it in a variable named find
find=${@: -1}

# we alsoo need a variable for storing index
# initially we take its value to be -1
flag=-1

# We will iterate the full array (smp) to check for the required element
for i in "${!smp[@]}";
do
    if [ ${smp[$i]} -eq $find ]
    then
        flag=$i
    fi
done

# If there was as element the index would be changed and we will display that
# otherwise we will print an error message
# $(($flag+1)) is done to convert to 1 based indexing
if [ $flag -ne -1 ]
then
    echo "Element $find found at index $(($flag+1))."
else
    echo "Element not found in the given array."
fi