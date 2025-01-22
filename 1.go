package main

import "fmt"

func f(x float64) float64 {
	return x*x - 6*x + 9
}

func main() {
	var x0, x1, x2 float64
	var i int

	fmt.Scan(&x0, &x1)

	fmt.Println("X0 =", x0)
	fmt.Println("X1 =", x1)

	for i = 2; i <= 9; i++ {
		x2 = x1 - f(x1)*(x1-x0)/(f(x1)-f(x0))
		fmt.Printf("X%d = %g\n", i, x2)
		x0 = x1
		x1 = x2
	}
}
