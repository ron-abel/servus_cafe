@extends('client.mainLayout.layout')

@section('title', 'Servus cafe - Studen Login Credentials Required')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
  <section class="container">
    @if (session()->has('success'))
    <div class="alert alert-success" role="alert"> {{ session()->get('success') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @elseif(session()->has('error'))
    <div class="alert alert-danger" role="alert"> {{ session()->get('error') }}
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    @endif

    <form action="{{url('/student/order')}}" method="post">
      @csrf
      <div class="card p-0">
        <div class="card header-tab border-0 mt-0 pb-0">
          <h2>Mahwah Sandwich Pre-order Form</h2>
          <span><b>Orders must be placed before 9:30am</b></span>
          <span>
            <b>( Please note all orders not picked up will still be charged if the student does not cancel their order by 10am the day of service)</b>
          </span>
        </div>
        <hr>
        <div class="border-0 card mt-0 pt-0">
          <span>The respondent's email <b>(24wuj01@mahwah.k12.nj.us)</b> was recorded on submission of this form.</span>
        </div>
      </div>

      <div class="form-group card text-field">
        <label for="exampleFormControlInput1">Last Name <span class="required">*</span></label>
        <input type="text" class="form-control" value="{{$user->last_name}}" disabled id="exampleInputEmail1" aria-describedby="emailHelp">
      </div>

      <div class="form-group card text-field">
        <label for="exampleFormControlInput1">First Name <span class="required">*</span></label>
        <input type="text" class="form-control" value="{{$user->first_name}}" disabled id="exampleInputEmail1" aria-describedby="emailHelp">
      </div>

      <div class="form-group card text-field">
        <label for="exampleFormControlInput1">Student ID number <span class="required">*</span></label>
        <input type="text" class="form-control" value="{{$user->student_id}}" disabled id="exampleInputEmail1" aria-describedby="emailHelp">
      </div>

      <div class="form-group card">
        @error('location')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="hidden" name="location">
        <label for="exampleFormControlInput1">Pickup Time <span class="required">*</span></label>
        @foreach($location as $single)
        <div class="form-check radio1">
          <input class="form-check-input" type="radio" name="location" id="{{$single->name}}" value="{{$single->id}}">
          <label class="form-check-label" for="{{$single->name}}">
            {{$single->name}}
          </label>
        </div>
        @endforeach

      </div>

      <div class="form-group card date-card">
        @error('order_date')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="exampleFormControlInput1">Date of the Order <span class="required">*</span></label>
        <input type="date" name="order_date" id="datepicker" class="form-control" value="{{ date('Y-m-d') }}">
      </div>

      <div class="card use-dropdown">
        <span>Use dropdown boxes to order or customize your entire sandwich</span>
      </div>

      <div class="form-group card">
        @error('sandwich')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="hidden" name="sandwich">
        <label for="exampleFormControlInput1">Popular Sandwiches <span class="required">*</span></label>
        @foreach($sandwiches as $sandwich)
        <div class="form-check radio1">
          <input class="form-check-input" type="radio" name="sandwich" id=" {{$sandwich->sandwich_name}}" value=" {{$sandwich->id}}" onchange="toggleSandwichInput()">
          <label class="form-check-label" for=" {{$sandwich->sandwich_name}}">
            {{$sandwich->sandwich_name}}
          </label>
        </div>
        @endforeach
        <div class="form-check radio1">
          <input class="form-check-input" type="radio" name="sandwich" id="other_sandwich" value="other" onchange="toggleOtherSandwichInput()">
          <label class="form-check-label" for="other_sandwich">
            Other
          </label>
        </div>
      </div>
      <div class="form-group card text-area">
        @error('other_sandwich')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="exampleFormControlInput1">If other,please write here what you want!</label>
        <input type="text" class="form-control" name="other_sandwich" id="other_sandwich_field" aria-describedby="emailHelp" disabled>
      </div>

      <div class="form-group card">
        @error('topping')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <input type="hidden" name="topping">
        <label for="exampleFormControlInput1">Toppings and Bread type <span class="required">*</span></label>
        @foreach($toppings as $topping)
        <div class="form-check radio1">
          <input class="form-check-input" type="checkbox" name="topping[]" id="{{$topping->topping_name}}" value="{{$topping->id}}">
          <label class="form-check-label" for="{{$topping->topping_name}}">
            {{$topping->topping_name}}
          </label>
        </div>
        @endforeach
        <div class="form-check radio1">
          <input class="form-check-input" type="checkbox" name="other_topping_type" id="other_topping">
          <label class="form-check-label" for="other_topping">
            Other
          </label>
        </div>
      </div>
      <div class="form-group card text-area">
        @error('other_topping')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <label for="exampleFormControlInput1">If other,please write here what you want!</label>
        <input type="text" class="form-control" name="other_topping" id="other_topping" aria-describedby="emailHelp">
      </div>
      <div class="card">
        <div class="row p-0 m-0 border-0">
          <div class="p-0 m-0 border-0">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
      </div>

    </form>
  </section>
  @endsection
  <script>
    function toggleOtherSandwichInput() {
    var otherSandwichRadio = document.getElementById('other_sandwich');
    var otherSandwichInput = document.getElementById('other_sandwich_field');

    otherSandwichInput.disabled = !otherSandwichRadio.checked;
  }
    function toggleSandwichInput() {
    var otherSandwichInput = document.getElementById('other_sandwich_field');
    if (!otherSandwichInput.hasAttribute('disabled')) {
    otherSandwichInput.setAttribute('disabled', 'true');
}
  }
  </script>