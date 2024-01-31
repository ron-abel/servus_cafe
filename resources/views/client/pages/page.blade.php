@extends('client.mainLayout.layout')

@section('title', 'Servus cafe - Studen Login Credentials Required')

@section('content')
<div class="content d-flex flex-column flex-column-fluid" id="kt_content">
<section class="container">
   
   <form action="">
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
       <input type="text" class="form-control" value="" disabled id="exampleInputEmail1" aria-describedby="emailHelp">
     </div>

     <div class="form-group card text-field">
       <label for="exampleFormControlInput1">First Name <span class="required">*</span></label>
       <input type="text" class="form-control" value="" disabled id="exampleInputEmail1" aria-describedby="emailHelp" >
     </div>

     <div class="form-group card text-field">
       <label for="exampleFormControlInput1">Student ID number <span class="required">*</span></label>
       <input type="number" class="form-control" value="" disabled id="exampleInputEmail1" aria-describedby="emailHelp" >
     </div>

     <div class="form-group card">
       <label for="exampleFormControlInput1">Pickup Location <span class="required">*</span></label>
       <div class="form-check radio">
         <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
         <label class="form-check-label" for="gridRadios1">
           Main Cafe @Snack Line
         </label>
       </div>
       <div class="form-check radio">
         <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
         <label class="form-check-label" for="gridRadios2">
           Thunderbird Cafe
         </label>
       </div>
       <div class="form-check radio">
         <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3" >
         <label class="form-check-label" for="gridRadios3">
           Thunderbird Cafe
         </label>
       </div>

     </div>

     <div class="form-group card date-card">
       <label for="exampleFormControlInput1">Date of the Order <span class="required">*</span></label>
       <input type="date" id="datepicker" class="form-control" >
     </div>

     <div class="card use-dropdown">
       <span>Use dropdown boxes to order or customize your entire sandwich</span>
     </div>

     <div class="form-group card">
       <label for="exampleFormControlInput1">Popular Sandwiches <span class="required">*</span></label>
     
       <div class="form-check radio">
         <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="option1" checked>
         <label class="form-check-label" for="gridRadios1">
          ff
         </label>
       </div>
      
       <!-- <div class="form-check radio">
         <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="option2">
         <label class="form-check-label" for="gridRadios2">
          Chicken Bacon Ranch
         </label>
       </div>
       <div class="form-check radio">
         <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="option3">
         <label class="form-check-label" for="gridRadios3">
           Turkey and Cheese
         </label>
       </div>
       <div class="form-check radio">
         <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios4" value="option4">
         <label class="form-check-label" for="gridRadios3">
           Ham and Cheese
         </label>
       </div>
       <div class="form-check radio">
         <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios5" value="option5">
         <label class="form-check-label" for="gridRadios3">
           Cheese Only
         </label>
       </div>
       <div class="form-check radio">
         <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios6" value="option6">
         <label class="form-check-label" for="gridRadios3">
           Buffalo Chicken
         </label>
       </div>
       <div class="form-check radio">
         <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios7" value="option7">
         <label class="form-check-label" for="gridRadios3">
           Other
         </label>
       </div> -->
     </div>

     <div class="form-group card text-area">
       <label for="exampleFormControlInput1">If other,please write here what you want!</label>
       <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
     </div>
   
     <div class="form-group card">
       <label for="exampleFormControlInput1">Toppings and Bread type <span class="required">*</span></label>
      
       <div class="form-check radio">
         <input class="form-check-input" type="checkbox" name="gridCheckbox" id="gridCheckbox1" value="option1">
         <label class="form-check-label" for="gridCheckbox1">
           ss
         </label>
       </div>
      
       <!-- <div class="form-check radio">
         <input class="form-check-input" type="checkbox" name="gridCheckbox" id="gridCheckbox2" value="option2" checked>
         <label class="form-check-label" for="gridCheckbox2">
          Tomato
         </label>
       </div>
       <div class="form-check radio">
         <input class="form-check-input" type="checkbox" name="gridCheckbox" id="gridCheckbox3" value="option3">
         <label class="form-check-label" for="gridCheckbox3">
           Oil and Viniger
         </label>
       </div>
       <div class="form-check radio">
         <input class="form-check-input" type="checkbox" name="gridCheckbox" id="gridCheckbox4" value="option4">
         <label class="form-check-label" for="gridCheckbox3">
           Mayo
         </label>
       </div>
       <div class="form-check radio">
         <input class="form-check-input" type="checkbox" name="gridCheckbox" id="gridCheckbox5" value="option5">
         <label class="form-check-label" for="gridCheckbox3">
           Chipotle Sauce
         </label>
       </div>
       <div class="form-check radio">
         <input class="form-check-input" type="checkbox" name="gridCheckbox" id="gridCheckbox6" value="option6" checked>
         <label class="form-check-label" for="gridCheckbox3">
           Hot Sauce
         </label>
       </div>
       <div class="form-check radio">
         <input class="form-check-input" type="checkbox" name="gridCheckbox" id="gridCheckbox7" value="option7">
         <label class="form-check-label" for="gridCheckbox3">
           Caesar Dressing
         </label>
       </div>
       <div class="form-check radio">
         <input class="form-check-input" type="checkbox" name="gridCheckbox" id="gridCheckbox7" value="option7">
         <label class="form-check-label" for="gridCheckbox3">
           Caesar Dressing
         </label>
       </div>
       <div class="form-check radio">
         <input class="form-check-input" type="checkbox" name="gridCheckbox" id="gridCheckbox7" value="option7">
         <label class="form-check-label" for="gridCheckbox3">
           Ranch
         </label>
       </div>
       <div class="form-check radio">
         <input class="form-check-input" type="checkbox" name="gridCheckbox" id="gridCheckbox7" value="option7">
         <label class="form-check-label" for="gridCheckbox3">
           Onions
         </label>
       </div>
       <div class="form-check radio">
         <input class="form-check-input" type="checkbox" name="gridCheckbox" id="gridCheckbox7" value="option7">
         <label class="form-check-label" for="gridCheckbox3">
           Banana Peppers
         </label>
       </div>
       <div class="form-check radio">
         <input class="form-check-input" type="checkbox" name="gridCheckbox" id="gridCheckbox7" value="option7">
         <label class="form-check-label" for="gridCheckbox3">
           Spinach Wrap
         </label>
       </div>
       <div class="form-check radio">
         <input class="form-check-input" type="checkbox" name="gridCheckbox" id="gridCheckbox7" value="option7">
         <label class="form-check-label" for="gridCheckbox3">
           Garlic Pesto Wrap
         </label>
       </div>
       <div class="form-check radio">
         <input class="form-check-input" type="checkbox" name="gridCheckbox" id="gridCheckbox7" value="option7">
         <label class="form-check-label" for="gridCheckbox3">
           Sundried Tomato Basil
         </label>
       </div>
       <div class="form-check radio">
         <input class="form-check-input" type="checkbox" name="gridCheckbox" id="gridCheckbox7" value="option7">
         <label class="form-check-label" for="gridCheckbox3">
           Plain Wrap
         </label>
       </div>
       <div class="form-check radio">
         <input class="form-check-input" type="checkbox" name="gridCheckbox" id="gridCheckbox7" value="option7">
         <label class="form-check-label" for="gridCheckbox3">
           Wheat Wrap
         </label>
       </div>
       <div class="form-check radio">
         <input class="form-check-input" type="checkbox" name="gridCheckbox" id="gridCheckbox7" value="option7">
         <label class="form-check-label" for="gridCheckbox3">
           Hoagie
         </label>
       </div>
       <div class="form-check radio">
         <input class="form-check-input" type="checkbox" name="gridCheckbox" id="gridCheckbox7" value="option7">
         <label class="form-check-label" for="gridCheckbox3">
           Extra Chicken Additional $1.00
         </label>
       </div> -->
     </div>
     <div class="card">
       <div class="row p-0 m-0 border-0">
         <div class="p-0 m-0 border-0">
           <button type="button" class="btn btn-primary">Submit</button>
         </div>
       </div>
     </div>

   </form>
 </section>
@endsection