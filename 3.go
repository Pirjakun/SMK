package main

import "fmt"

const NMAX int = 1024

type Book struct {
	title string
	year  int
}

func sortBooks(books *[NMAX]Book, count int) {
	for i := 0; i < count-1; i++ {
		for j := 0; j < count-i-1; j++ {
			if books[j].year > books[j+1].year {
				books[j], books[j+1] = books[j+1], books[j]
			}
		}
	}
}

func main() {
	var books [NMAX]Book
	bookCount := 0

	var title string
	var year int

	for {
		fmt.Scan(&title)
		if title == "#" {
			break
		}
		fmt.Scan(&year)

		if year >= 1950 && year <= 1990 {
			books[bookCount] = Book{title, year}
			bookCount++
		}
	}

	if bookCount == 0 {
		fmt.Println("Tidak ada buku dalam kategori Klasik Modern.")
		return
	}

	sortBooks(&books, bookCount)

	fmt.Println("Buku dengan tahun penerbitan paling tua:")
	maxOldBooks := 3
	if bookCount < maxOldBooks {
		maxOldBooks = bookCount
	}
	for i := 0; i < maxOldBooks; i++ {
		fmt.Printf("%s %d\n", books[i].title, books[i].year)
	}

	newest := books[bookCount-1]
	fmt.Printf("Terbaru: %s\n", newest.title)

	fmt.Printf("Jumlah Buku Klasik Modern: %d\n", bookCount)

	sum := 0
	for i := 0; i < bookCount; i++ {
		sum += books[i].year
	}
	avg := float64(sum) / float64(bookCount)
	fmt.Println("Rata-rata tahun penerbitan Buku Klasik adalah", avg)
}
