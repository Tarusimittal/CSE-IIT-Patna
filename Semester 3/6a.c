//Tarusi Mittal
//1901CS65

#include <stdio.h>
#include <stdlib.h>

//swap function to swap double type variables
void swap(int* xp, int* yp){ 
    int temp = *xp; 
    *xp = *yp; 
    *yp = temp; 
}

//swap function to swap int type variables
void swap1(double* xp, double* yp){ 
    double temp = *xp; 
    *xp = *yp; 
    *yp = temp; 
}

int main(){
    //input the no of elements
    int n;
    scanf("%d",&n);
    //inistialianing an double array to store duration and loss associated with each and inouting them 
    double loss[n];
    double time[n];
    for(int i=0;i<n;i++){
        scanf("%lf",&loss[i]);
    }
    for(int i=0;i<n;i++){
        scanf("%lf",&time[i]);
    }
    // initialysing an array to store the duration/time value
    // as we want to minimise loss overall
    // the best approach is to arrange the entries in an ascending order of the duraton/loss array
    double divide[n];
    // index array to store th eindex so that printing is easier
    int index[n];
    for(int i=0;i<n;i++){
        divide[i]=time[i]/loss[i];
        index[i]=i+1;
    }
    // sorting the array in ascending order
	int min_idx; 
	for (int i = 0; i < n - 1; i++) { 
		min_idx = i; 
		for (int j = i + 1; j < n; j++) 
			if (divide[j] < divide[min_idx]) 
				min_idx = j; 
		swap1(&divide[min_idx], &divide[i]);
		swap(&index[min_idx],&index[i]);
	} 
    //printing the index array
    for(int i=0;i<n;i++){
        printf("%d ",index[i]);
    }
    return 0;
}