package path

import (
	"fmt"
	"reflect"
)

type One string

func (t One) Demo() {
	val := reflect.ValueOf(t)
	//ind := reflect.Indirect(val)
	fmt.Printf(":%v\n", val.String()) //<*main.Two Value>
}
