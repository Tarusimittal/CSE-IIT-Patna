
# Tarusi Mittal
# 1901Cs65

#  void Sorting(int arr[], int n){
#    int i, j;
#    for (i = 0; i < n-1; i++){
#    int yesno = 0;
#    for (j = 0; j < n-i-1; j++)
#        if (arr[j] > arr[j+1]){
#            swap(&arr[j], &arr[j+1]);
#            yesno = 1;
#        }
#        if(yesno == 0)break;
#     }
#  }


.data
arr: .word -10 8 0 7 -9 7 9 1
n: .word 8
msg1: .asciiz " "

.text
main:
	la $t1, arr		     	# pointer to first element of array
	lw $s0, n			      # n is the length of the array
	sub $s0, $s0, 1			# s0 = n-1

	la $s5, 0			      # to check if any swap has occurred in the innerloop or not
	la $s1, 0			      # i = 0

bubblefor:
	la $s2, 0			      # j = 0
	sub $t9, $s0, $s1		# (n - 1) - i //till when we need to run the loop

	innerfor:
		add $t2, $t1, 4		# next element in the array
		lw $t4, ($t1)		  # current element which is arr[j]
		lw $t5, ($t2)		  # next element which is arr[j+1]

		ble $t4, $t5, dontswap	# if arr[j] <= arr[j+1], then do not swap

		jal swapthem
		add $s5, $zero, 1

		dontswap:
			beq $s2, $t9, endinnerfor   # if s2==t9 then end the loop
			addu $s2, $s2, 1            # j++
			addu $t1, $t1, 4            # arr[j+1]
			b innerfor                  # back to the loop

	endinnerfor:
		beqz $s5, endbubblefor              # will terminate if no swaps s5 is count(0/1)
		beq $s1, $s0, endbubblefor          # if equals to length
		add $s1, $s1, 1                     # s1++; //i++
		la $t1, arr                        #points to initial element
		b bubblefor

endbubblefor:
	la $t1, arr                    # t1 points to 0th element
	and $s1, $zero, $zero          # count for printing

print:
	lw $a0, ($t1)
	li $v0, 1
	syscall

	li $v0, 4
	la $a0, msg1
	syscall

	beq $s1, $s0, exit

	addu $s1,$s1,1
	addu $t1,$t1,4
	b print

exit:

	li $v0, 10		# exit
	syscall

swapthem:
	sw $t4, ($t2)
	sw $t5, ($t1)
	jr 	$ra
