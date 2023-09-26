#include <stdio.h>
#include <stdlib.h>

void merge(int arr[], int l, int m, int r){

	int len1 = m - l + 1;
	int len2 = r - m;

	int Left[len1], Right[len2];

	for (i = 0; i < len1; i++)
		Left[i] = arr[l + i];
	for (j = 0; j < len2; j++)
		Right[j] = arr[m + 1 + j];

	int i = 0;
	int j = 0;
	int k = l;
	while (i < len1 && j < len2){
		if (Left[i] <= Right[j]){
			arr[k] = Left[i];
			i++;
		}
		else{
			arr[k] = Right[j];
			j++;
		}
		k++;
	}

	while (i < len1){
		arr[k] = Left[i];
		i++;
		k++;
	}

	while (j < len2){
		arr[k] = Right[j];
		j++;
		k++;
	}
}

void sorting_array(int arr[], int l, int r){
	if (l < r){
		int m = l + (r - l) / 2;
		sorting_array(arr, l, m);
		sorting_array(arr, m + 1, r);
		merge(arr, l, m, r);
	}
}

int main(){
	int n;
	printf("Enter the length of the array: ");
	scanf("%d",&n);

  int arr[n];
	printf("Enter the numbers in the array: ");

	for(int i=0;i<n;i++){
		scanf("%d",&arr[i]);
	}

	printf("Given array is \n");
	for (int i = 0; i < n; i++){
		printf("%d ", arr[i]);
	}

	printf("\n");

	sorting_array(arr, 0, n - 1);

	printf("\nFinal Array after Sorting: \n");
	for (int i = 0; i < n; i++){
		printf("%d ", arr[i]);
	}

	printf("\n");
	printf("\nEnter the value of k\n");
	int k;
	scanf("%d",&k);

	printf("\n	Kth smallest element in the array is\n");
	for(int i=0;i<=k;i++){
		ans=arr[i];
	}
	printf("%d",ans);

	return 0;
}
