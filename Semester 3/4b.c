//Tarusi Mittal
//1901Cs65
//Assuming we have to arrange in ascending order

#include <stdlib.h> 
#include <stdio.h> 
#include <math.h>

int analyse(int arr[], int chotta, int bada, int base);
void reverse_i(int arr[], int i);
void SortingMain(int arr[], int n);

int main(){ 
	int n;
    printf("Enter the count of numbers in the array \n");
    scanf("%d",&n);
	int arr[n];
    printf("Enter the elements of the array \n");
    for(int i=0;i<n;i++){
      
      scanf("%d",&arr[i]);
    }
	SortingMain(arr, n); 
	for(int i=0;i<n;i++){
      printf("%d ",arr[i]);
    }
	return 0; 
} 

//Binary Search function 
int analyse(int arr[], int chotta, int bada, int base){ 
	int temp;
    //If base is greater than the last element, then return -1
	if(base > arr[bada]){ 
		return -1; 
    }
	//If base is smaller than or equal to the first element, 
	//then return the first element
	if(base <= arr[chotta]){ 
		return chotta; 
    }
	//temp is set as the middle value of it
	temp= (chotta + bada)/2;

	//If base is same as middle element, then return temp
	if(arr[temp] == base){
		return temp; 
    }

	// If base is greater than arr[temp]	
	if(arr[temp] < base){ 
		if(temp + 1 <= bada && base <= arr[temp+1]){ 
			return temp + 1; 
        }
		else{
			return analyse(arr, temp+1, bada, base);
        }
	} 

	// If base is smaller than arr[temp]	
	if (temp - 1 >= chotta && base > arr[temp-1]){ 
		return temp; 
    }
	else{
		return analyse(arr, chotta, temp - 1, base);
    }
} 

// Reverses arr[0..i]
// Given this function works in O(1)
void reverse_i(int arr[], int i){ 
	int cnt;
    int begin = 0; 
	while (begin < i) 
	{ 
		cnt = arr[begin]; 
		arr[begin] = arr[i]; 
		arr[i] = cnt; 
		begin++; 
		i--; 
	} 
} 

// Function to sort an array using insertion sort, binary search and reverse_i
void SortingMain(int arr[], int n){ 
	int i, j; 

	// Start from the second element and one by one insert arr[i]
	for(i = 1;i <n;i++){ 
		// Find the smallest element in arr[0..i-1] which is also greater than 
		// or equal to arr[i] 
		int j = analyse(arr, 0, i-1, arr[i]); 

		// Check if there was no element greater than arr[i] 
		if (j != -1){ 
			// Put arr[i] before arr[j] using following four reverse operations 
			reverse_i(arr, j-1); 
			reverse_i(arr, i-1); 
			reverse_i(arr, i); 
			reverse_i(arr, j); 
		} 
	} 
} 

//total running time of above algorithm is O(nlogn).considering reverse function takes O(1) time
//analyse function returns us the index of the smallest element which is greater than the given element till i
//If there is no such element, it returns -1. if this is the case the function is stopped
//Otherwise we need to put that arr[i] just before the element found
// When we insert an element arr[i], we can use binary search to find position of arr[i] in O(Logi) time.
//there fore total time complexity goes to o(nlogn)