package main

import "fmt"

const NMAX int = 1024

type Himpunan [NMAX]int

func ada(himp Himpunan, n, v int) int {
	for i := 0; i < n; i++ {
		if himp[i] == v {
			return i
		}
	}
	return -1
}

func himpSama(h1 Himpunan, n int) bool {
	var h2 Himpunan
	for i := 0; i < n; i++ {
		fmt.Scan(&h2[i])
		idx := ada(h1, n, h2[i])
		if idx == -1 {
			return false
		}
		h1[idx] = -h1[idx]
	}
	return true
}

func bacaHimp(h1 *Himpunan, n int) {
	for i := 0; i < n; i++ {
		fmt.Scan(&h1[i])
	}
}

func main() {
	var n int
	var h1 Himpunan
	fmt.Scanln(&n)
	bacaHimp(&h1, n)
	if himpSama(h1, n) {
		fmt.Println("Kedua himpunan sama")
	} else {
		fmt.Println("Kedua himpunan berbeda")
	}
}
