//Tarusi Mittal
//1901CS65
#include <stdio.h>
#include <stdlib.h>

void arraydecinc(int arr[],int n){
    
  //initialising an array to store the longest increasing seuence from the back
  int increasing[n];
  //initialising the last elemnt to be 1 as it is always true
  //the array will store the length of the increasing sequence from that index to the last
  increasing[n-1]=1;
  for(int i = n-2; i >= 0; i--){
      //every element would atleast be of 1 length
      increasing[i]=1;
    for(int j = n-1; j > i; j--){
        //checking the condition for updation
        //1,. value should be larger
        //2. the current value should be greater than the previous value
        if(arr[i] < arr[j] && increasing[i] < increasing[j] + 1){
           increasing[i] = increasing[j] + 1;
        }
    }
  }
  
  //initialising an array to store the longest decreasing seuence 
  int decreasing[n]; 
  decreasing[0]=1;
  for(int i = 1; i < n; i++){
      //every element would atleast be of 1 length
      decreasing[i]=1;
    for(int j = 0; j < i; j++){
        //checking the condition for updation
        //1. value should be larger
        //2. the current value should be greater than the previous value
        if (arr[i] < arr[j] && decreasing[i] < decreasing[j] + 1){
        decreasing[i] = decreasing[j] + 1;
        }
    }
  }
 
  //checking the condition for the maximum length
  // it will be value of increasing sequence + the value of decreaing sequence
  int finallength = increasing[0] + decreasing[0];
  //stroing the index for use in printing the required subsequence
  int storeindex=0;
  for(int i = 1; i < n; i++){
    if (increasing[i] + decreasing[i] > finallength){
        finallength=increasing[i]+decreasing[i];
        storeindex=i;
    }
  }
  // when we add increasing and decreasing araay the current element is counted twice
  //so there is a need to decrease its length by 1 unit
  finallength--;
  
  //initialysing an array to store the subsequnce that needs to be printed
  int print[finallength];
  //initialysing a variable to store the value of the array which is just less than the storeindex
  int base=decreasing[storeindex]-1;
  int temp=base;
  //initialysing the condition to store the element at storeindex position
  int condition=decreasing[storeindex];
  for(int i=storeindex;i>=0;i--){
      //storing the values in the print array
	if(decreasing[i]==condition){
		print[temp--]=arr[i];
		condition--;
	}
  }
  //initialysing the base valude back to storeindex
  base++;

  //updating the condition to now store the increasing sequence
  condition=increasing[storeindex]-1;
  for(int i=storeindex;i<n;i++){
      //storing the value in the print array
	if(increasing[i]==condition){
		print[base++]=arr[i];
		condition--;
	}
  } 
  //printing the required array
  for(int i=0;i<finallength;i++){
     int a=print[i];
	 printf("%d ",a);
  }
  //printing the index
  printf("=> Element %d is ym here",storeindex+1);
  
  //printing the max length
  printf("\nLength = %d",finallength);

}
int main(){
    int n;
    //taking the input of number of elements in the array
    scanf("%d",&n);
    int arr[n];
    for(int i=0;i<n;i++){
        int a;
        //taking input of the array
        scanf("%d",&a);
        arr[i]=a;
    }
    //passing through the function
    arraydecinc(arr,n);
    return 0;
} 