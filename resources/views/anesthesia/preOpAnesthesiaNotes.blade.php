@extends('template.header')
@section('section')
<div class="content-wrapper">
    <div class="content-header row">
        <div class="content-header-left col-md-9 col-12 mb-2">
            <div class="row breadcrumbs-top">
                <div class="col-12">
                    <h2 class="content-header-title float-start mb-0">Pre-Op Anestesia Notes</h2>
                    <!-- <div class="breadcrumb-wrapper">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index-2.html">Home</a>
                            </li>
                            <li class="breadcrumb-item"><a href="#">Patient 360</a>
                            </li>
                            <li class="breadcrumb-item active"><a href="#">MR Registration</a>
                            </li>
                        </ol>
                    </div> -->
                </div>
            </div>
        </div>
        <div class="content-header-right text-md-end col-md-3 col-12 d-md-block d-none">
            <div class="mb-1 breadcrumb-right">
            </div>
        </div>
    </div>
    <!-- dd mm yy -->
    <div class="content-body">
        <!-- Basic Horizontal form layout section start -->
        <!-- Basic multiple Column Form section start -->
        <section id="multiple-column-form">


            <form class="form">

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Patient Demographics</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-6">
                                <div class="mb-1">
                                    <label class="form-label" for="First-Name">Patient MRN</label>
                                    <input type="text" id="First-Name" class="form-control" placeholder="Patient MRN" name="Patient-MRN">
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="mb-1">
                                    <label class="form-label" for="Middle-Name">Patient Name</label>
                                    <input type="text" id="Middle-Name" class="form-control" placeholder="Patient Name" name="Patient-Name">
                                </div>
                            </div>
                            <div class="col-md-1 col-6">
                                <div class="mb-1">
                                    <label class="form-label" for="Age">Age</label>
                                    <input type="number" id="Age" class="form-control" placeholder="Age" name="Age">
                                </div>
                            </div>
                            <div class="col-md-1 col-6">
                                <div class="mb-1">

                                    <label class="form-label" for="DMY">DMY</label>
                                    <input type="text" id="Age" class="form-control" placeholder="Age" value="Years" name="Age">
                                </div>
                            </div>
                            <div class="col-md-2 col-6">
                                <div class="mb-1">
                                    <label class="form-label" for="city-column">Date of Opearation</label>
                                    <!-- <input type="text" id="Age" class="form-control" placeholder="Gender" name="Age"> -->
                                    <input type="date" id="DBO" class="form-control" placeholder="D.O.B" name="DBO">

                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-4 col-6">
                                <div class="mb-1">
                                    <label class="form-label" for="First-Name">Written By</label>
                                    <input type="text" id="First-Name" class="form-control" placeholder="Written By" name="Written-By">
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="mb-1">
                                    <label class="form-label" for="First-Name">Notes Date</label>
                                    <input type="Date" id="First-Name" class="form-control" placeholder="Notes Date" name="Written-By">
                                </div>
                            </div>


                        </div>

                    </div>
                </div>

                <!--  anestesia consultant section -->
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Anesthesia</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4 col-6">
                                <div class="mb-1">
                                    <label class="form-label" for="First-Name">Anestesia Consultant</label>
                                    <select class="form-select flex-grow-1" name="Blood-Group">
                                        <option value=""> Dr. Kashif Anwar</option>
                                        <option value="">Dr. Abidullah</option>
                                        <option value="">Dr. Kashif Anwar</option>
                                        <option value="">Dr. Abdul Nasir</option>
                                        <option value="">Dr. RafiUllah</option>
                                    </select>
                                    <!-- <input type="text" id="First-Name" class="form-control" placeholder="Anestesia Consultant" name="Anestesia-Consultant"> -->
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="mb-1">
                                    <label class="form-label" for="First-Name">Anestesia Registrar/MO</label>
                                    <!-- <input type="text" id="First-Name" class="form-control" placeholder="Anestesia Incharge" name="Anestesia-Incharge"> -->
                                    <select class="form-select flex-grow-1" name="Blood-Group">
                                        <option value=""> Dr. Kashif Anwar</option>
                                        <option value="">Dr. Abidullah</option>
                                        <option value="">Dr. Kashif Anwar</option>
                                        <option value="">Dr. Abdul Nasir</option>
                                        <option value="">Dr. RafiUllah</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 col-6">
                                <div class="mb-1">
                                    <label class="form-label" for="First-Name">Anestesia Assistant</label>
                                    <select class="form-select flex-grow-1" name="Blood-Group">
                                        <option value=""> Dr. Kashif Anwar</option>
                                        <option value="">Dr. Abidullah</option>
                                        <option value="">Dr. Kashif Anwar</option>
                                        <option value="">Dr. Abdul Nasir</option>
                                        <option value="">Dr. RafiUllah</option>
                                    </select>
                                    <!-- <input type="text" id="First-Name" class="form-control" placeholder="Anestesia Assistant" name="Anestesia-Assistant"> -->
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Notes</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <div class="mb-1">
                                    <label class="form-label" for="kinName">Pre Anestesia History</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-1">
                                    <label class="form-label" for="kinName">Medical History</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-3 col-6">
                                <div class="mb-1">
                                    <label class="form-label" for="kinName">Addiction History</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-3 col-6">
                                <div class="mb-1">
                                    <label class="form-label" for="kinName">Alergies</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 col-6 ">
                                <div class="row">
                                    <div class="col-6">
                                        <div class="me-1">
                                            <label class="form-label" for="kinName">Anticipated IV problem</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                                <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                                <label class="form-check-label" for="inlineCheckbox2">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <div class="me-1">
                                            <label class="form-label" for="kinName">NPO</label>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="d-flex">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                                                <label class="form-check-label" for="inlineCheckbox1">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                                <label class="form-check-label" for="inlineCheckbox2">No</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">
                                                <label class="form-check-label" for="inlineCheckbox2">Others</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ">
                                    <div class="col-md-6 col-6">
                                        <label class="form-label" for="kinName">Airway Assesment</label>
                                        <div class="">
                                            <input type="text" id="First-Name" class="form-control" placeholder="Airway Assesment" name="Anestesia-Assistant">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <label class="form-label" for="kinName">Mouth Opening</label>
                                        <div class="">
                                            <input type="text" id="First-Name" class="form-control" placeholder="Mouth Opening" name="Anestesia-Assistant">
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6 col-6">
                                        <label class="form-label" for="kinName">Defination</label>
                                        <div class="">
                                            <input type="text" id="First-Name" class="form-control" placeholder="Defination" name="Anestesia-Assistant">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <label class="form-label" for="kinName">Neck Extension</label>
                                        <div class="">
                                            <input type="text" id="First-Name" class="form-control" placeholder="Mouth Opening" name="Anestesia-Assistant">
                                        </div>
                                    </div> -->
                                </div>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <div class="mb-1">
                                    <label class="form-label" for="kinName">Clinical Findings</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="row">

                                    <div class="col-md-6 col-6">
                                        <label class="form-label" for="kinName">Dentition</label>
                                        <div class="">
                                            <input type="text" id="First-Name" class="form-control" placeholder="Dentition" name="Anestesia-Assistant">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-6">
                                        <label class="form-label" for="kinName">Neck Extension</label>
                                        <div class="">
                                            <input type="text" id="First-Name" class="form-control" placeholder="Neck Extension" name="Anestesia-Assistant">
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="form-label" for="kinName">MP</label>
                                        <select class="form-select flex-grow-1" name="Blood-Group">
                                            <option value=""> --</option>
                                            <option value="A+">1</option>
                                            <option value="A-">2</option>
                                            <option value="B+">3</option>
                                            <option value="B-">4</option>
                                        </select>

                                    </div>
                                    <div class="col-md-3 col-6">
                                        <label class="form-label" for="kinName">TWD</label>
                                        <div class="">
                                            <!-- <input type="text" id="First-Name" class="form-control" placeholder="" name="Anestesia-Assistant"> -->
                                            <select class="form-select flex-grow-1" name="Blood-Group">
                                                <option value=""> --</option>
                                                <option value="A+">1</option>
                                                <option value="A-">2</option>
                                                <option value="B+">3</option>
                                                <option value="B-">4</option>
                                            </select>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <div class="mb-1">
                                    <label class="form-label" for="kinName">Investigation</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6 col-6">
                                <div class="mb-1">
                                    <label class="form-label" for="kinName">Pre-Op Instruction</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6 col-6">
                                <div class="mb-1">
                                    <label class="form-label" for="kinName">Remarks</label>
                                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary me-1 waves-effect waves-float waves-light">Submit</button>
                            <button type="reset" class="btn btn-outline-secondary waves-effect">Reset</button>
                        </div>

                    </div>
                </div>

            </form>


        </section>
    </div>

    @endsection