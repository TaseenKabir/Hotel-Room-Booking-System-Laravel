<!DOCTYPE html>
<html lang="en">
<head>
    <base href="/public">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Book {{ $room->name }} - Keto Hotel</title>
    <meta name="description" content="Book your stay at {{ $room->name }} - Keto Hotel">
    <!-- bootstrap css -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- style css -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Responsive-->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- datepicker css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
</head>
<body class="main-layout">
    <!-- loader -->
    <div class="loader_bg">
        <div class="loader"><img src="images/loading.gif" alt="#"/></div>
    </div>
    <!-- end loader -->
    <!-- header -->
    @include('home.header')
    <!-- end header -->

    <div class="booking-section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    @if (Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif 

                    @if (Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error')}}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif 
                </div>
                <!-- Room Details Column -->
                <div class="col-lg-6 col-md-6">
                    <div class="room-details-card">
                        <div class="room-image-container">
                            <img src="images/{{ $room->image }}" alt="{{ $room->name }}">
                            <div class="room-badge">Featured Room</div>
                        </div>
                        <div class="room-info">
                            <h1 class="room-title">{{ $room->name }}</h1>
                            <p class="room-description">{{ $room->description }}</p>
                            
                            <div class="price-tag">
                                ৳{{ number_format($room->price, 2) }} <span>/ per night</span>
                            </div>
                            
                            <div class="room-features">
                                <div class="feature-item">
                                    <i class="fas fa-users"></i>
                                    <span>Capacity: {{ $room->max_capacity }} persons</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-bed"></i>
                                    <span>Room Type: {{ $room->name }}</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-wifi"></i>
                                    <span>Free WiFi</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-tv"></i>
                                    <span>Smart TV</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-snowflake"></i>
                                    <span>Air Conditioning</span>
                                </div>
                                <div class="feature-item">
                                    <i class="fas fa-coffee"></i>
                                    <span>Free Breakfast</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Booking Form Column -->
                <div class="col-lg-6 col-md-6">
                    <div class="booking-card">
                        <div class="booking-header">
                            <h2>Book This Room</h2>
                            <p class="text-muted">Fill in your details to confirm your booking</p>
                        </div>

                        <form id="bookingForm" method="POST" action="{{ route('store.booking',$room->id)}}">
                            @csrf
                            <input type="hidden" name="room_type_id" value="{{ $room->id }}">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="name">
                                            <i class="fas fa-user"></i> Full Name
                                        </label>
                                        <input type="text" 
                                               class="form-control @error('name') is-invalid @enderror" 
                                               id="name" 
                                               name="name" 
                                               value="{{old('name', Auth::user()->name ?? '')}}"
                                               placeholder="Enter your full name" 
                                               >
                                        @error('name')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="phone">
                                            <i class="fas fa-phone"></i> Phone Number
                                        </label>
                                        <input type="tel" 
                                               class="form-control @error('phone') is-invalid @enderror" 
                                               id="phone" 
                                               name="phone" 
                                               value="{{old('phone', Auth::user()->phone ?? '')}}"
                                               placeholder="Enter your phone number" 
                                               >
                                        @error('phone')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="email">
                                    <i class="fas fa-envelope"></i> Email Address
                                </label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{old('email', Auth::user()->email ?? '')}}"
                                       placeholder="Enter your email address" 
                                       >
                                @error('email')
                                    <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="check_in">
                                            <i class="fas fa-calendar-check"></i> Check-in Date
                                        </label>
                                        <input type="date" 
                                               class="form-control datepicker @error('check_in') is-invalid @enderror" 
                                               id="check_in" 
                                               name="check_in" 
                                               value="{{old('check_in')}}"
                                               placeholder="Select check-in date" 
                                               >
                                        @error('check_in')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="form-label" for="check_out">
                                            <i class="fas fa-calendar-times"></i> Check-out Date
                                        </label>
                                        <input type="date" 
                                               class="form-control datepicker @error('check_out') is-invalid @enderror" 
                                               id="check_out" 
                                               name="check_out" 
                                               value="{{old('check_out')}}"
                                               placeholder="Select check-out date" 
                                               >
                                        @error('check_out')
                                            <p class="invalid-feedback">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" name="total_amount" id="total_amount_input">
                            </div>

                            <div class="form-group">
                                <label class="form-label" for="special_requests">
                                    Special Requests
                                </label>
                                <input type="text" 
                                       class="form-control" 
                                       id="special_requests" 
                                       name="special_requests" 
                                       placeholder="Special Requests (optional)" 
                                    >
                            </div>
                           

                            <!-- Booking Summary -->
                            <div class="booking-summary">
                                <h4>Booking Summary</h4>
                                <div class="summary-item">
                                    <span>Room Price (per night):</span>
                                    <span>৳<span id="room-price">{{ number_format($room->price, 2) }}</span></span>
                                </div>
                                <div class="summary-item">
                                    <span>Number of Nights:</span>
                                    <span><span id="nights-count">0</span> nights</span>
                                </div>
                                <div class="summary-item total">
                                    <span>Total Amount:</span>
                                    <span>৳<span id="total-amount" name="total_amount">0.00</span></span>
                                </div>
                            </div>

                            <button type="submit" class="btn-book" id="submit-btn">
                                <i class="fas fa-lock me-2"></i> Confirm Booking
                            </button>
                            
                            <div class="text-center mt-3">
                                <p class="text-muted">
                                    <i class="fas fa-shield-alt me-1"></i>
                                    Your information is secure and will not be shared
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    @include('home.footer')
    <!-- end footer -->

    <!-- Javascript files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        $(document).ready(function() {
            // Initialize datepickers
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            
            flatpickr("#check_in", {
                minDate: "today",
                dateFormat: "Y-m-d",
                onChange: function(selectedDates, dateStr) {
                    if (dateStr) {
                        const checkIn = new Date(dateStr);
                        const nextDay = new Date(checkIn);
                        nextDay.setDate(nextDay.getDate() + 1);
                        
                        flatpickr("#check_out", {
                            minDate: nextDay,
                            dateFormat: "Y-m-d"
                        });
                        
                        calculateTotal();
                    }
                }
            });
            
            flatpickr("#check_out", {
                minDate: tomorrow,
                dateFormat: "Y-m-d",
                onChange: function() {
                    calculateTotal();
                }
            });
            
            // Page loader
            setTimeout(function() {
                $('.loader_bg').fadeOut('slow');
            }, 1500);
        });

        function updateBookingSummary() {
    const checkInVal = document.getElementById('check_in').value;
    const checkOutVal = document.getElementById('check_out').value;

    if (!checkInVal || !checkOutVal) {
        document.getElementById('nights-count').innerText = 0;
        document.getElementById('total-amount').innerText = '0.00';
        return;
    }

    const checkIn = new Date(checkInVal);
    const checkOut = new Date(checkOutVal);

    const diffTime = checkOut - checkIn;
    const nights = diffTime / (1000 * 60 * 60 * 24);

    if (nights <= 0) {
        document.getElementById('nights-count').innerText = 0;
        document.getElementById('total-amount').innerText = '0.00';
        return;
    }

    const price = parseFloat(
        document.getElementById('room-price').innerText.replace(',', '')
    );

    const total = nights * price;

    document.getElementById('nights-count').innerText = nights;
    document.getElementById('total-amount').innerText = total.toFixed(2);
    document.getElementById('total_amount_input').value = total.toFixed(2);

}

document.getElementById('check_in').addEventListener('change', updateBookingSummary);
document.getElementById('check_out').addEventListener('change', updateBookingSummary);
    </script>
</body>
</html>