package main

import (
	"fmt"
	"net/http"
	footshop "stock/generated"
	"stock/internal"
)

func main() {
	fmt.Println("starting server...")
	http.ListenAndServe(":8002", footshop.NewStockServer(internal.NewServer(), nil))
}
