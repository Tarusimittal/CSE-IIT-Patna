#!/bin/bash
# Question 2

# The code id divided into two functions
# The first function finds the factorial of the given nu,ber
# The second function finds the sum of prime numbers less than or equal to the given number
# In the end we multiply the result of the two functions

# Recursive function to calculate factorial of a number
function findfact() { 
    # Base case for recursive function if passed number is less than =1 return 1
    if (( $1 <= 1 ))
    then
        echo 1
    else	
        # we make a recursive call
        echo $(( $(findfact $(( $1 - 1 ))) * $1))
    fi
}

#ans a stores the value of factorial of the given number
ansa=$(findfact $1)

# Function to find sum of prime less than or equal to a number
function sumprime() {
      #Base case if we reach the number 1 return 0
	if (($1 <= 1))
	then
		echo 0
	else
            # we will check for all the numbers starting from 2 as it is the smallest prime number
		for((i=2;i<$1;++i))
		do
			if [[ $(($1 % $i)) -eq 0 ]]
				# the number now is not a prime number
			then
				echo $(sumprime $(( $1 - 1)) )
				return
			fi
		done
        		# the number is prime so add it to the final ans
		echo $(($(sumprime $(( $1 - 1))) + $1 ))
	fi
}

#ans b stores the value of sum of prime numbers less than the given number
ansb=$(sumprime $1)

if [ $# -ne 1 ]
then
	echo "Error: Please enter only 1 number"
	exit 1
fi

echo "The required answer is : $(( $ansa * $ansb ))"

