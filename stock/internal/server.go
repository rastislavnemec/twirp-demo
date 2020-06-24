package internal

import (
	"context"
	"github.com/twitchtv/twirp"
	footshop "stock/generated"
)

type Server struct {
}

func NewServer() footshop.Stock {
	return &Server{}
}

func (s *Server) ReservationCreate(
	ctx context.Context,
	req *footshop.ReservationCreateRequest,
) (*footshop.ReservationCreateResponse, error) {
	if req.Quantity < 5 {
		return nil, twirp.InvalidArgumentError("quantity", "minimum value is 5")
	}

	var result footshop.ReservationCreateResponse_Result

	if req.Quantity <= 10 {
		result = footshop.ReservationCreateResponse_RESULT_SUCCESS
	} else {
		result = footshop.ReservationCreateResponse_RESULT_UNAVAILABLE
	}

	return &footshop.ReservationCreateResponse{
		Result: result,
	}, nil
}
