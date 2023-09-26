#!/bin/bash
# Question 3

# We take two numbers as inputs 
# We have made a function findxor whixh returns to us the xor of two numbers

# We define a function to find and print XOR value
function findxor() {
   # value 1 and 2 are the inputs
    value1=$1
    value2=$2

    # ans stores the value of current bits of xor
    ans=0
    # exponent is the no of times the resut needs to be raised
    exponent=1

    # In the while loop we will take the numbers bit by bit starting for the least significant bit
    while [[ value1 -gt 0 ]] || [[ value2 -gt 0 ]]
    do
        tvalue1=$(($value1 % 2))
        tvalue2=$(($value2 % 2))

	# we know A xor B = A*B(complement) + B*A(complement)
        bitAns=$(($tvalue1 * !$tvalue2 + $tvalue2 * !$tvalue1))

      # Add in the result
        ans=$(($ans + $bitAns * $exponent))

	# The numbers will be right shifted
        value1=$(($value1 / 2))
        value2=$(($value2 / 2))

      # exponent raises by 2
        exponent=$(($exponent * 2))

    done
    echo "$ans"
}


if [[ $# -ne 2 ]]
then
    echo "Error: Invalid Input, Enter 2 numbers as arguments"
    exit 1
else
    echo "The XOR of $1 and $2 is: $(findxor $1 $2) "
fi

