//Tarusi Mittal
//1901CS65
// Assumption- we are taking the input of no of cities

#include <stdio.h>
#include <stdlib.h>
#include <math.h>
#include <string.h>

#define f(i,n) for(int i=0;i<n;i++)

//declaring final cost as 0 initially
int finalcost=0;

//constructing a struct with the size of min heap
struct tt{
    int city;
    int cost;
}heapMin[1000009];


void deletetop(int temp);
void add_city(int current_cost,int city, int temp);
void uptodown(int temp);
void downtoup(int temp,int index);


int main(){
    //taking input of number of cities
    int n,temp=1;
    printf("Enter No of cities to enter: \n");
    scanf("%d",&n);

    //making a matrix to store cost of building the roads
    //grey array to check if the city is alreday visited or not
    //initially grey array is 0;
	int arr[n][n],grey[n];
	f(i,n){
	    grey[i]=0;
	    f(j,n){
	        scanf("%d",&arr[i][j]);
	    }
	}

    //inialising the values of heap
	heapMin[0].city=0;
	heapMin[0].cost=0;


	//using prims algorithm
	while (temp>=0){
	    temp=temp-1;

	    int current_city=heapMin[0].city;
	    int current_cost=heapMin[0].cost;


        //removing the top element
	    deletetop(temp);


    if(grey[current_city]==0){
        // if teh city is not visited
        //give it the value of 1;
	    grey[current_city]++;
	    f(i,n){
	        if(current_city!=i){
              if(arr[current_city][i]!=0){
              //adding the cities in the heap
	            add_city(arr[current_city][i],i,temp);
	            temp=temp+1;
              }
	        }
	    }
	    //adding current cost to final cost
	    f(i,current_cost){
	        finalcost++;
	    }

    }
    else{
        //if city is already visited
	        continue;
	    }
	}

  //printing the cost to connect cities
	printf("The final cost is %d",finalcost);
	return 0;
}


void deletetop(int temp){

    //removing the top element
    heapMin[0].city=heapMin[temp].city;
    heapMin[0].cost=heapMin[temp].cost;

    //upadating the heap
    uptodown(temp);
}

//adding the elemnt in the min heap
void add_city(int current_cost,int city, int temp){

    //first adding it on the last
    heapMin[temp].city=city;
    heapMin[temp].cost=current_cost;

    //updating the heap
    downtoup(temp,temp);
}

//updating the min heap from up
void uptodown(int temp){
    int index=0;
    int whi=1;

    while (whi>0){
        int swapindex;
        int ind2=2*index;
        int temp2;
        if (ind2+1>=temp){
            break;
        }
        if (ind2+2>=temp){
            temp2=ind2+1;
            swapindex=temp2;
        }
        else if (heapMin[ind2+1].cost<=heapMin[ind2+2].cost){
            temp2=ind2+1;
            swapindex=temp2;
        }
        else{
            temp2=ind2+2;
            swapindex=temp2;
        }

        if (heapMin[index].cost<=heapMin[swapindex].cost){
            break;
        }

        int tempcity=heapMin[index].city, tempcost=heapMin[index].cost;

        heapMin[index].city=heapMin[swapindex].city, heapMin[index].cost=heapMin[swapindex].cost;

        heapMin[swapindex].city=tempcity, heapMin[swapindex].cost=tempcost;

        //giving the value of index to changed value
        index=swapindex;
    }
}

//updating the heap from bottom
void downtoup(int temp,int index){

    while(index>0){
        //swapindex = current index divided by 2
        int swapindex;
        swapindex=index/2;
        if (heapMin[swapindex].cost>heapMin[index].cost!=0){
            int tempcity, tempcost;

            tempcity=heapMin[index].city, tempcost=heapMin[index].cost;

            heapMin[index].city=heapMin[swapindex].city, heapMin[index].cost=heapMin[swapindex].cost;

            heapMin[swapindex].city=tempcity, heapMin[swapindex].cost=tempcost;
        }
        else{
            break;
        }

        //giving the value of index to changed value
        index=swapindex;
    }
}
