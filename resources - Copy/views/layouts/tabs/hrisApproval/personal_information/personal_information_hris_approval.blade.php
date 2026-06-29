@extends('layouts.admin')

@section('content')

      <style>
            .btn-add {
                  background: #28a745;
                  color: #fff;
                  font-size: 14px;
                  border-radius: 20px;
                  padding: 8px 20px;
                  text-decoration: none;
            }

            .btn-export {
                  background: #6c757d;
                  color: #fff;
                  font-size: 14px;
                  border-radius: 20px;
                  padding: 8px 20px;
                  text-decoration: none;
            }

            .modal-body {
                  padding: 2em;
            }

            .bg-primary {
                  background-color: black;
            }
      </style>

      <?php  
                        $df = date('Y-m-d', strtotime("-1 Month"));
      $dt = date('Y-m-d');
      //           echo json_encode($authorityToDeduct);
      //     return;
                  ?>

      <div class="container-fluid mt-4 card-container">
            <!-- <h1>Overtime Approval</h1> -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                  <h5>Personal Information</h5>
                  <h5></h5>

            </div>

            <ul class="nav nav-tabs" id="myTab" role="tablist">
                  <li class="nav-item" role="presentation">
                        <a class="nav-link active" id="pending-tab" data-bs-toggle="tab" href="#pending" role="tab"
                              aria-controls="pending" aria-selected="true">Pending</a>
                  </li>
                  <li class="nav-item" role="presentation">
                        <a class="nav-link" id="history-tab" data-bs-toggle="tab" href="#history" role="tab"
                              aria-controls="history" aria-selected="false">History</a>
                  </li>
            </ul>

            <div class="tab-content" id="myTabContent">
                  <div class="tab-pane fade show active" id="pending" role="tabpanel" aria-labelledby="pending-tab">
                        <div class="table-container">
                              <table class="table data-table" id="datatablesPending">
                                    <thead>
                                          <tr>
                                                <th>#</th>
                                                <th>IdentityId</th>
                                                <th>Employee Name</th>
                                                <th>Request No.</th>
                                                <th>Change Count</th>
                                                <th>View</th>

                                          </tr>
                                    </thead>
                                    <tbody>
                                          <?php
                                                $count = 1; 
                                                 ?>
                                          @foreach($personalInformation as $list)
                                                <tr class="open-atd" data-formNo="{{ $list->formNo }}" style="cursor:pointer;">
                                                      <td>{{ $count }}</td>
                                                      <td>{{ $list->IdentityId }}</td>
                                                      <td>{{ $list->name}}</td>
                                                      <td>{{ $list->dateCreated }}</td>
                                                      <td>{{ $list->purpose }}</td>
                                                      <td>{{ $list->totalAmount }}</td>
                                                      <td>{{ $list->amountDeductedPerPayroll }}</td>
                                                      <td>{{ $list->effectiveDate . ' - ' . $list->lastDateofDeduction }}</td>
                                                      <td>{{ $list->terms }}</td>
                                                      <td>{{ $list->remarks }}</td>
                                                </tr>
                                                <?php      $count++; ?>
                                          @endforeach
                                    </tbody>
                              </table>
                              <div class="modal fade" id="atdModal" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                          <div class="modal-content" id="atdModalContent">
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
                  <div class="tab-pane fade" id="history" role="tabpanel" aria-labelledby="history-tab">
                        <div class="table-container">
                              <table class="table data-table" id="datatablesHistory">
                                    <thead>
                                          <tr>
                                                <th>#</th>
                                                <th>IdentityId</th>
                                                <th>Employee Name</th>
                                                <th>Request No.</th>
                                                <th>Change Count</th>
                                                <th>Status</th>
                                                <th>View</th>
                                          </tr>
                                    </thead>
                                    <tbody>
                                          @foreach($personalInformation as $list)
                                                <tr class="open-atd-history" data-formNo="{{ $list->formNo }}"
                                                      style="cursor:pointer;">
                                                      <td>{{$list->appNo}}</td>
                                                      <td>{{$list->formNo}}</td>
                                                      <td>{{$list->effectiveDate}}</td>
                                                      <td>{{$list->dateCreated}}</td>
                                                      <td>{{$list->purpose}}</td>
                                                      <td>{{$list->totalAmount}}</td>
                                                      <td>{{$list->amountDeductedPerPayroll}}</td>
                                                      <td>{{$list->effectiveDate . " - " . $list->lastDateofDeduction}}</td>
                                                      <td>{{$list->terms}}</td>
                                                      <td>{{$list->remarks}}</td>
                                                </tr>
                                          @endforeach
                                    </tbody>
                              </table>
                              <div class="modal fade" id="atdModalHistory" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                          <div class="modal-content" id="atdModalContentHistory">
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>

      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
      <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

      <script>
            
            window.addEventListener('DOMContentLoaded', event => {

                  const datatablesPending = document.getElementById('datatablesPending');
                  if (datatablesPending) {
                        new simpleDatatables.DataTable(datatablesPending);

                  }

                  const datatablesHistory = document.getElementById('datatablesHistory');
                  if (datatablesHistory) {
                        new simpleDatatables.DataTable(datatablesHistory);
                  }
            });

            $(document).ready(function () {
                  Filter_HistoryRequester(0, 0, 3);
            });




      </script>
@endsection