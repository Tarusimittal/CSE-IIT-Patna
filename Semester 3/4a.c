//Tarusi MIttal
//1901CS65

#include <stdlib.h> 
#include <stdio.h> 
#include <math.h>

//List of all the functions used in the code
void createheap(int arr[], int *n);
void heapify(int arr[], int n,  int i);
void swap(int *indexA, int *indexB);
int findLargeDel(int arr[], int *n);
void New(int arr[], int *n, int newelement);

/*void printHeap(int arr[], int n){
	for (int i = 0; i < n; ++i){
	    printf("%d ",arr[i]);
	}
	
}*/

int main(){
    //taking input
    int n;
    printf("Enter the count of elements in the array \n");
    scanf("%d",&n);
    int arr[n];
    printf("Enter the elements of the array \n");
    for(int i=0;i<n;i++){
     int a;
     scanf("%d",&a);
     arr[i]=a;
    }
    //creating a heap from the array
    createheap(arr, &n); 
    //was used to check the code//printHeap(arr, n); 
    int cnt=n;
    //executing the code until the size of array reduces to 1
    while(cnt>1){
     //finding the maximum element 1 and 2
	 int a =findLargeDel(arr,&cnt); 
     int b =findLargeDel(arr,&cnt); 
     if(a-b!=0){
        int temp=a-b;
        //inserting a new element if the differenvce between the two largest numbers is not equal to zero
        New(arr,&cnt,temp);
     }
    }
    if(cnt==1){
        printf("%d\n",arr[0]);
    } 
    else {
    	printf("0\n");
    }
	
	return 0; 
} 

//function to create a heap
//this function is of the order O(n)
void createheap(int arr[], int *n){
    //initialysing the current index
    int i = (*n/ 2)-1; 
    for(int j=i;j>=0;j--){
        //heapify at each node
        heapify(arr, *n, j);
    }
}

//function to heapify
void heapify(int arr[], int n,  int i){
    //equating the left and right child
    int childLeft = 2 * i + 1;
    int childRight = 2 * i + 2;
    int largest = i;
    //condition checking for left child so that overflow doesnot occur
    if(childLeft < n && arr[childLeft] > arr[i]){
        largest = childLeft;
    }
    //checking condition for right vhild so that overflow doensnot occur
    if(childRight < n && arr[childRight] > arr[largest]){
        largest = childRight;
    }
    //swapinf the elements and heapify
    if(largest != i){
       swap(&arr[i], &arr[largest]); 
        heapify(arr, n, largest);
    }
    //checking if the parent node is still larger that the child node if not then again heapify else continue
    if(largest==i){
	    if(arr[i/2]<arr[i]){
	        swap(&arr[i/2],&arr[largest]);
	        heapify(arr,n,i/2);
	    }
	} 
}

//function to perform the swap operation
void swap(int *indexA, int *indexB){ 
    int temp = *indexA; 
    *indexA = *indexB; 
    *indexB = temp; 
}

//returning the largest element and deleting it
//the function id of the order O(log(n))
int findLargeDel(int arr[], int *n){
    int largest=arr[0];
    int temp = arr[*n - 1]; 
    //replacing the root with first element 
    arr[0] = temp;
    //decreasing size of heap by 1 
    *n = *n - 1;
    //heapify the root node 
    heapify(arr, *n, 0); 
    return largest;
} 

//function to insert the new node
//this function has the order O(log(n))
void New(int arr[], int *n, int newelement){ 
    //increasing the size of Heap by 1 
    *n = *n + 1;
    //inserting the element at end of Heap
    //here insertion is done directly and not by the method of inserting -infinity first
    arr[*n - 1] = newelement;
    //heapify the new node
    heapify(arr, *n, *n - 1); 
}