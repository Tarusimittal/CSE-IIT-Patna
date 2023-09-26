#include <stdio.h>
#include <sys/types.h>
#include <unistd.h>
#include <stdlib.h>
int func(){
	//Consider a parent process passed to this function
	//At first fork it will create two process lets say C1 and p
	//At the second fork c1 will make 2 process namely C2 and C1
	//And similarly p will make two processes namely C3 and p
	// Now each of this process will print hello onvce from func and then from main function

   	//       P
		//     /   \
		//    C1    P
		fork();

		//       P
		//     /   \
		//    C1    P
		//   / \   / \
		//  C2 C1 C3  P

		fork();
    printf("Hello\t");
}
int main() {

 func();
 printf("Hello\t");
 exit(0);
}
