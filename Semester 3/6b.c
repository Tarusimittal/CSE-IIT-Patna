//Tarusi Mittal
//1901CS65
//Assumption: length of names do not exceed 25

#include <stdio.h>
#include <stdlib.h>
#include <string.h>

//swap function to swap double type variables
void swap(int* xp, int* yp){ 
    int temp = *xp; 
    *xp = *yp; 
    *yp = temp; 
}
int solve(char *X, char *Y, int m, int n){ 
    // Create a table to store lengths of longest 
    // Common suffixes of substrings.  
   
    int solve[m+1][n+1]; 
    int result = 0;  
    // To store length of the  
    // longest common substring 
    // the array is formed by the bottom up approach
    for(int i=0; i<=m; i++){ 
        for(int j=0; j<=n; j++){
            if(i == 0 || j == 0) 
                solve[i][j] = 0; 
  
            else if(X[i-1] == Y[j-1]){ 
                solve[i][j] = solve[i-1][j-1] + 1;
                if(result<solve[i][j]){
                    result=solve[i][j];
                }
                else{
                    result=result;
                }
                
            } 
            else solve[i][j] = 0; 
        } 
    } 
    return result; 
} 
  

int main(){
    int n;
    scanf("%d",&n);
    char s[n][25];
    //inputing the strings one by one
    for(int i=0;i<n;i++){
         scanf("%s",s[i]);
    }
    int neighbour[n][n];
    for(int i=0;i<n;i++){
        for(int j=0;j<n;j++){
            neighbour[i][j]=0;
        }    
    }
    
    int a,b;
    char basic[25];
    scanf("%d",&a);
    scanf("%d",&b);
    scanf("%s",basic);
    printf("The required adjacency list is: \n");
    //code to print the adjacency list and store information in the firsthop array
    for(int i=0;i<n;i++){
        printf("%s: ",s[i]);
        for(int j=0;j<n;j++){
            if(i!=j){
                //checking if they have a commom substring 
                int length1=strlen(s[i]);
                int length2=strlen(s[j]);
                int current = solve(s[i],s[j],length1,length2);
                if(current>=2){
                    neighbour[i][j]=1;
                    neighbour[j][i]=1;
                    //printing the adjacent lists
                    printf("%s ",s[j]);
                }
            }
        }
        printf("\n");
    }
    
    
    //finding the influence of every person
    int influence[n];
    for(int i=0;i<n;i++){
        influence[i]=0;
    }
    
    //filling the influence array 
    for(int i=0;i<n;i++){
        
        //finding 1-hop neighbor
        int mm=0,nn=0;
        for(int j=0;j<n;j++){
            if(neighbour[i][j]==1)mm++;
        }
        
        //Finding the 2-hop neighbor
        for(int j=0;j<n;j++){
            if(neighbour[i][j]==1){
                for(int k=0;k<n;k++){
                    if(neighbour[j][k]==1&&neighbour[i][k]==0&&k!=i){
                        nn++;
                        neighbour[i][k]=2;
                    }
                }
            }
        }
        influence[i]=mm*mm+nn;
    }
    
    //findining intimacy of every two persons
    int intimacy[n][n];

	for(int i=0;i<n;i++){
	    for(int j=0;j<n;j++){
	        intimacy[i][j]=0;
	    }
	}
    for(int i=0;i<n;i++){
		for(int j=0;j<n;j++){
			if(neighbour[i][j]==1){
				int temp=0;
				for(int k=0;k<n;k++){
	 			   if(neighbour[i][k]&&neighbour[j][k])
					   temp++;
				}
				intimacy[i][j]=temp;
			}
		}
	}
    
   
    
    return 0;
}