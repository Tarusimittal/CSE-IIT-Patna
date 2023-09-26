#include <stdio.h>
using namespace std;

// auxiliary function for swap
void swap(int* a, int* b)
{
	int t = *a;
	*a = *b;
	*b = t;
}

/* This function takes first element as pivot, places
the pivot element at its correct position in sorted
array, and places all smaller (smaller than pivot)
to left of pivot and all greater elements to right
of pivot */

// arr[] = Array to be sorted,
// low   = Start index
// high  = End index 

void quick(int arr[], int left, int right) {
	int l = left, r = right, p = left;
	
	while (l < r) {
		while (arr[l] <= arr[p] && l < right)
			l++;
		while (arr[r] >= arr[p] && r > left)
			r--;
		if (l >= r) {
			swap(&arr[p], &arr[r]);
			quick(arr, left, r - 1);
			quick(arr, r + 1, right);
			return;
		}
		swap(&arr[l], &arr[r]);
	}
}
void printArray(int arr[], int size)
{
	for (int i = 0; i < size; i++)
		printf("%d ",arr[i]);
	printf("\n");
}

int main()
{
	int n,k;
	
	// printf("Please enter n: ");
	scanf("%d",&n);
	int arr[n];
	
	// printf("Please enter the element of array: ");
	
	for(int i=0;i<n;i++){
		scanf("%d",&arr[i]);
	}
	
	// printf("Please enter k: ");
	scanf("%d",&k);
	

	quick(arr, 0, n - 1);
	
	printf("Sorted array: \n");
	printArray(arr, n);
	
	printf("\nKth(%d) smallest element:\n%d",k,arr[k-1]);
	
	
	return 0;
}
