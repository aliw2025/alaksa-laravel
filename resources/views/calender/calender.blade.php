@extends('template.header')
@section('section')
<div class="content-wrapper">
  <div class="content-header row">
  </div>
  <div class="content-body">
    <!-- Full calendar start -->
    <section>
      <div class="app-calendar overflow-hidden border">
        <div class="row g-0">
          <!-- Sidebar -->
          <div class="col app-calendar-sidebar flex-grow-0 overflow-hidden d-flex flex-column" id="app-calendar-sidebar">
            <div class="sidebar-wrapper">
              <div class="card-body d-flex justify-content-center">
                <button class="btn btn-primary btn-toggle-sidebar w-100 waves-effect waves-float waves-light" data-bs-toggle="modal" data-bs-target="#add-new-sidebar">
                  <span class="align-middle">Add Event</span>
                </button>
              </div>
              <div class="card-body pb-0">
                <h5 class="section-label mb-1">
                  <span class="align-middle">Filter</span>
                </h5>
                <div class="form-check mb-1">
                  <input type="checkbox" class="form-check-input select-all" id="select-all" checked="">
                  <label class="form-check-label" for="select-all">View All</label>
                </div>
                <div class="calendar-events-filter">
                  <div class="form-check form-check-danger mb-1">
                    <input type="checkbox" class="form-check-input input-filter" id="personal" data-value="personal" checked="">
                    <label class="form-check-label" for="personal">OR Room 01</label>
                  </div>
                  <div class="form-check form-check-primary mb-1">
                    <input type="checkbox" class="form-check-input input-filter" id="business" data-value="business" checked="">
                    <label class="form-check-label" for="business">OR Room 02</label>
                  </div>
                  <div class="form-check form-check-warning mb-1">
                    <input type="checkbox" class="form-check-input input-filter" id="family" data-value="family" checked="">
                    <label class="form-check-label" for="family">OR Room 03</label>
                  </div>
                  <div class="form-check form-check-success mb-1">
                    <input type="checkbox" class="form-check-input input-filter" id="ss" data-value="holiday" checked="">
                    <label class="form-check-label" for="holiday">OR Room 04</label>
                  </div>
                  <div class="form-check form-check-info mb-1">
                    <input type="checkbox" class="form-check-input input-filter" id="etc" data-value="etc" checked="">
                    <label class="form-check-label" for="etc">OR Room 05</label>
                  </div>
                    <div class="form-check form-check-info mb-1">
                        <input type="checkbox" class="form-check-input input-filter" id="s" data-value="etc" checked="">
                        <label class="form-check-label" for="etc">OR Room 06</label>
                    </div>
                </div>
              </div>
            </div>
            <div class="mt-auto">
              <img src="../../../app-assets/images/pages/calendar-illustration.png" alt="Calendar illustration" class="img-fluid">
            </div>
          </div>
          <!-- /Sidebar -->

          <!-- Calendar -->
          <div class="col position-relative">
            <div class="card shadow-none border-0 mb-0 rounded-0">
              <div class="card-body pb-0">
                <div id="calendar" class="fc fc-media-screen fc-direction-ltr fc-theme-standard">
                  <div class="fc-header-toolbar fc-toolbar ">
                    <div class="fc-toolbar-chunk">
                      <div class="fc-button-group"><button class="fc-sidebarToggle-button fc-button fc-button-primary" type="button"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu ficon">
                            <line x1="3" y1="12" x2="21" y2="12"></line>
                            <line x1="3" y1="6" x2="21" y2="6"></line>
                            <line x1="3" y1="18" x2="21" y2="18"></line>
                          </svg></button><button class="fc--button fc-button fc-button-primary" type="button"></button></div>
                      <div class="fc-button-group"><button class="fc-prev-button fc-button fc-button-primary" type="button" aria-label="prev"><span class="fc-icon fc-icon-chevron-left"></span></button><button class="fc-next-button fc-button fc-button-primary" type="button" aria-label="next"><span class="fc-icon fc-icon-chevron-right"></span></button><button class="fc--button fc-button fc-button-primary" type="button"></button></div>
                      <h2 class="fc-toolbar-title">May 2022</h2>
                    </div>
                    <div class="fc-toolbar-chunk"></div>
                    <div class="fc-toolbar-chunk">
                      <div class="fc-button-group"><button class="fc-dayGridMonth-button fc-button fc-button-primary fc-button-active" type="button">month</button><button class="fc-timeGridWeek-button fc-button fc-button-primary" type="button">week</button><button class="fc-timeGridDay-button fc-button fc-button-primary" type="button">day</button><button class="fc-listMonth-button fc-button fc-button-primary" type="button">list</button></div>
                    </div>
                  </div>
                  <div class="fc-view-harness fc-view-harness-active" style="height: 1122.96px;">
                    <div class="fc-daygrid fc-dayGridMonth-view fc-view">
                      <table class="fc-scrollgrid  fc-scrollgrid-liquid">
                        <thead>
                          <tr class="fc-scrollgrid-section fc-scrollgrid-section-header ">
                            <td>
                              <div class="fc-scroller-harness">
                                <div class="fc-scroller" style="overflow: hidden;">
                                  <table class="fc-col-header " style="width: 1513px;">
                                    <colgroup></colgroup>
                                    <tbody>
                                      <tr>
                                        <th class="fc-col-header-cell fc-day fc-day-sun">
                                          <div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">Sun</a></div>
                                        </th>
                                        <th class="fc-col-header-cell fc-day fc-day-mon">
                                          <div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">Mon</a></div>
                                        </th>
                                        <th class="fc-col-header-cell fc-day fc-day-tue">
                                          <div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">Tue</a></div>
                                        </th>
                                        <th class="fc-col-header-cell fc-day fc-day-wed">
                                          <div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">Wed</a></div>
                                        </th>
                                        <th class="fc-col-header-cell fc-day fc-day-thu">
                                          <div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">Thu</a></div>
                                        </th>
                                        <th class="fc-col-header-cell fc-day fc-day-fri">
                                          <div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">Fri</a></div>
                                        </th>
                                        <th class="fc-col-header-cell fc-day fc-day-sat">
                                          <div class="fc-scrollgrid-sync-inner"><a class="fc-col-header-cell-cushion ">Sat</a></div>
                                        </th>
                                      </tr>
                                    </tbody>
                                  </table>
                                </div>
                              </div>
                            </td>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="fc-scrollgrid-section fc-scrollgrid-section-body  fc-scrollgrid-section-liquid">
                            <td>
                              <div class="fc-scroller-harness fc-scroller-harness-liquid">
                                <div class="fc-scroller fc-scroller-liquid-absolute" style="overflow: hidden auto;">
                                  <div class="fc-daygrid-body fc-daygrid-body-unbalanced " style="width: 1513px;">
                                    <table class="fc-scrollgrid-sync-table" style="width: 1513px; height: 1096px;">
                                      <colgroup></colgroup>
                                      <tbody>
                                        <tr>
                                          <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past" data-date="2022-05-01">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-01&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">1</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past" data-date="2022-05-02">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-02&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">2</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-tue fc-day-past" data-date="2022-05-03">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-03&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">3</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-wed fc-day-past" data-date="2022-05-04">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-04&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">4</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-thu fc-day-past" data-date="2022-05-05">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-05&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">5</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-fri fc-day-past" data-date="2022-05-06">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-06&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">6</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-sat fc-day-past" data-date="2022-05-07">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-07&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">7</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past" data-date="2022-05-08">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-08&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">8</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past" data-date="2022-05-09">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-09&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">9</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-tue fc-day-past" data-date="2022-05-10">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-10&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">10</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-wed fc-day-past" data-date="2022-05-11">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-11&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">11</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-thu fc-day-past" data-date="2022-05-12">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-12&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">12</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-fri fc-day-past" data-date="2022-05-13">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-13&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">13</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-sat fc-day-past" data-date="2022-05-14">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-14&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">14</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past" data-date="2022-05-15">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-15&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">15</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past" data-date="2022-05-16">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-16&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">16</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-tue fc-day-past" data-date="2022-05-17">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-17&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">17</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-wed fc-day-past" data-date="2022-05-18">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-18&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">18</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-event-harness" style="margin-top: 0px;"><a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past bg-light-info">
                                                    <div class="fc-event-main">
                                                      <div class="fc-event-main-frame">
                                                        <div class="fc-event-title-container">
                                                          <div class="fc-event-title fc-sticky">Dart Game?</div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="fc-event-resizer fc-event-resizer-start"></div>
                                                    <div class="fc-event-resizer fc-event-resizer-end"></div>
                                                  </a></div>
                                                <div class="fc-daygrid-event-harness" style="margin-top: 0px;"><a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past bg-light-warning">
                                                    <div class="fc-event-main">
                                                      <div class="fc-event-main-frame">
                                                        <div class="fc-event-title-container">
                                                          <div class="fc-event-title fc-sticky">Dinner</div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="fc-event-resizer fc-event-resizer-start"></div>
                                                    <div class="fc-event-resizer fc-event-resizer-end"></div>
                                                  </a></div>
                                                <div class="fc-daygrid-event-harness fc-daygrid-event-harness-abs" style="visibility: hidden; top: 0px; left: 0px; right: 0px;"><a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past bg-light-danger">
                                                    <div class="fc-event-main">
                                                      <div class="fc-event-main-frame">
                                                        <div class="fc-event-title-container">
                                                          <div class="fc-event-title fc-sticky">Meditation</div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="fc-event-resizer fc-event-resizer-start"></div>
                                                    <div class="fc-event-resizer fc-event-resizer-end"></div>
                                                  </a></div>
                                                <div class="fc-daygrid-event-harness fc-daygrid-event-harness-abs" style="visibility: hidden; top: 0px; left: 0px; right: 0px;"><a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past bg-light-primary">
                                                    <div class="fc-event-main">
                                                      <div class="fc-event-main-frame">
                                                        <div class="fc-event-title-container">
                                                          <div class="fc-event-title fc-sticky">Product Review</div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="fc-event-resizer fc-event-resizer-start"></div>
                                                    <div class="fc-event-resizer fc-event-resizer-end"></div>
                                                  </a></div>
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"><a class="fc-daygrid-more-link fc-more-link">+2 more</a></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-thu fc-day-past" data-date="2022-05-19">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-19&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">19</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-fri fc-day-today " data-date="2022-05-20">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-20&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">20</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-event-harness" style="margin-top: 0px;"><a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-today bg-light-danger">
                                                    <div class="fc-event-main">
                                                      <div class="fc-event-main-frame">
                                                        <div class="fc-event-title-container">
                                                          <div class="fc-event-title fc-sticky">Appointment
                                                          <p>This is tCPT</p>
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="fc-event-resizer fc-event-resizer-start"></div>
                                                    <div class="fc-event-resizer fc-event-resizer-end"></div>
                                                  </a></div>
                                                <div class="fc-daygrid-event-harness" style="margin-top: 0px;"><a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-today bg-light-primary">
                                                    <div class="fc-event-main">
                                                      <div class="fc-event-main-frame">
                                                        <div class="fc-event-title-container">
                                                          <div class="fc-event-title fc-sticky">Meeting With Client</div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="fc-event-resizer fc-event-resizer-start"></div>
                                                    <div class="fc-event-resizer fc-event-resizer-end"></div>
                                                  </a></div>
                                                <div class="fc-daygrid-event-harness fc-daygrid-event-harness-abs" style="visibility: hidden; top: 0px; left: 0px; right: -216.656px;"><a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-start fc-event-end fc-event-today bg-light-primary">
                                                    <div class="fc-event-main">
                                                      <div class="fc-event-main-frame">
                                                        <div class="fc-event-time">11:46a</div>
                                                        <div class="fc-event-title-container">
                                                          <div class="fc-event-title fc-sticky">Design Review</div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </a></div>
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"><a class="fc-daygrid-more-link fc-more-link">+1 more</a></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-sat fc-day-future" data-date="2022-05-21">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-21&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">21</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-event-harness" style="margin-top: 0px;"><a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-end fc-event-future bg-light-primary">
                                                    <div class="fc-event-main">
                                                      <div class="fc-event-main-frame">
                                                        <div class="fc-event-time">12a</div>
                                                        <div class="fc-event-title-container">
                                                          <div class="fc-event-title fc-sticky">Design Review</div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                  </a></div>
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="fc-daygrid-day fc-day fc-day-sun fc-day-future" data-date="2022-05-22">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-22&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">22</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-event-harness fc-daygrid-event-harness-abs" style="top: 0px; left: 0px; right: -216.141px;"><a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-future bg-light-success">
                                                    <div class="fc-event-main">
                                                      <div class="fc-event-main-frame">
                                                        <div class="fc-event-title-container">
                                                          <div class="fc-event-title fc-sticky">Family Trip</div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="fc-event-resizer fc-event-resizer-start"></div>
                                                    <div class="fc-event-resizer fc-event-resizer-end"></div>
                                                  </a></div>
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 28px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-mon fc-day-future" data-date="2022-05-23">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-23&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">23</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 28px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-tue fc-day-future" data-date="2022-05-24">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-24&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">24</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-wed fc-day-future" data-date="2022-05-25">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-25&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">25</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-thu fc-day-future" data-date="2022-05-26">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-26&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">26</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-fri fc-day-future" data-date="2022-05-27">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-27&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">27</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-sat fc-day-future" data-date="2022-05-28">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-28&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">28</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="fc-daygrid-day fc-day fc-day-sun fc-day-future" data-date="2022-05-29">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-29&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">29</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-mon fc-day-future" data-date="2022-05-30">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-30&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">30</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-tue fc-day-future" data-date="2022-05-31">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-05-31&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">31</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-wed fc-day-future fc-day-other" data-date="2022-06-01">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-06-01&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">1</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-event-harness" style="margin-top: 0px;"><a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-future bg-light-primary">
                                                    <div class="fc-event-main">
                                                      <div class="fc-event-main-frame">
                                                        <div class="fc-event-title-container">
                                                          <div class="fc-event-title fc-sticky">Monthly Meeting</div>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    <div class="fc-event-resizer fc-event-resizer-start"></div>
                                                    <div class="fc-event-resizer fc-event-resizer-end"></div>
                                                  </a></div>
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-thu fc-day-future fc-day-other" data-date="2022-06-02">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-06-02&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">2</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-fri fc-day-future fc-day-other" data-date="2022-06-03">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-06-03&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">3</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-sat fc-day-future fc-day-other" data-date="2022-06-04">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-06-04&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">4</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                        </tr>
                                        <tr>
                                          <td class="fc-daygrid-day fc-day fc-day-sun fc-day-future fc-day-other" data-date="2022-06-05">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-06-05&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">5</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-mon fc-day-future fc-day-other" data-date="2022-06-06">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-06-06&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">6</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-tue fc-day-future fc-day-other" data-date="2022-06-07">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-06-07&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">7</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-wed fc-day-future fc-day-other" data-date="2022-06-08">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-06-08&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">8</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-thu fc-day-future fc-day-other" data-date="2022-06-09">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-06-09&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">9</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-fri fc-day-future fc-day-other" data-date="2022-06-10">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-06-10&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">10</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                          <td class="fc-daygrid-day fc-day fc-day-sat fc-day-future fc-day-other" data-date="2022-06-11">
                                            <div class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                              <div class="fc-daygrid-day-top"><a class="fc-daygrid-day-number" data-navlink="{&quot;date&quot;:&quot;2022-06-11&quot;,&quot;type&quot;:&quot;day&quot;}" tabindex="0">11</a></div>
                                              <div class="fc-daygrid-day-events">
                                                <div class="fc-daygrid-day-bottom" style="margin-top: 0px;"></div>
                                              </div>
                                              <div class="fc-daygrid-day-bg"></div>
                                            </div>
                                          </td>
                                        </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /Calendar -->
          <div class="body-content-overlay">
          </div>
        </div>
      </div>

      <!-- Calendar Add/Update/Delete event modal-->
      <div class="modal modal-slide-in event-sidebar fade" id="add-new-sidebar">
        <div class="modal-dialog sidebar-lg">
          <div class="modal-content p-0">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
            <div class="modal-header mb-1">
              <h5 class="modal-title">Schedule Details</h5>
            </div>
            <div class="modal-body flex-grow-1 pb-sm-0 pb-3">
              <form class="event-form needs-validation" data-ajax="false" novalidate="novalidate">
                  <div class="mb-1 position-relative">
                      <label for="end-date" class="form-label">MR Number</label>
                      <input type="text" class="form-control">
                  </div>

                  <div class="mb-1 position-relative">
                      <label for="end-date" class="form-label">Patient Name</label>
                      <input type="text" class="form-control">
                  </div>
                  <div class="mb-1 position-relative">
                      <label for="end-date" class="form-label">Patient Type</label>
                      <select class="select2 select-add-guests form-select w-100 select2-hidden-accessible" aria-hidden="true">
                          <option value="Room 01">-- Select --</option>
                          <option value="Room 01">Elective</option>
                          <option value="Room 02">Emergency</option>
                      </select>
                  </div>
                <div class="mb-1 position-relative">
                  <label for="start-date" class="form-label">Start Time</label>
                  <input type="datetime-local" class="form-control" id="startdate" name="start-date">
                </div>
                <div class="mb-1 position-relative">
                  <label for="end-date" class="form-label">Tentative End Time</label>
                  <input type="datetime-local" class="form-control flatpickr-input" id="enddate">
                </div>
                <div class="mb-1">
                  <label for="event-url" class="form-label">OR Room</label>
                    <select class="select2 select-add-guests form-select w-100 select2-hidden-accessible" aria-hidden="true">
                        <option value="Room 01">-- Select --</option>
                        <option value="Room 01">Room 01</option>
                        <option value="Room 02">Room 02</option>
                        <option value="Room 03">Room 03</option>
                        <option value="Room 04">Room 04</option>
                        <option value="Room 05">Room 05</option>
                        <option value="Room 06">Room 06</option>
                    </select>
                </div>
                  <div class="mb-1">
                      <label for="event-url" class="form-label">Procedure (CPT)</label>
                      <select class="select2 select-add-guests form-select w-100 select2-hidden-accessible" aria-hidden="true">
                          <option value="Room 01">-- Select --</option>
                          <option value="Room 01">CABG</option>
                          <option value="Room 02">CABG 1</option>
                          <option value="Room 03">CABG 2</option>
                          <option value="Room 04">CABG 3</option>
                      </select>
                  </div>
                <div class="mb-1 select2-primary">
                  <label for="event-guests" class="form-label">Primary Consultant</label>
                  <div class="position-relative">
                      <select class="form-select flex-grow-1">
                          <option value="Room 01">-- Select --</option>
                          <option value="Room 01">Dr Abdul Nasir</option>
                          <option value="Room 02">Dr Muhammad Traiq</option>
                          <option value="Room 03">Dr Mubasir Zareen</option>
                          <option value="Room 04">Dr Ijaz Hussan</option>
                    </select>

                      <label for="event-guests" class="form-label">Assistant Surgeon</label>
                      <div class="position-relative">
                          <select class="form-select flex-grow-1">
                              <option value="Room 01">-- Select --</option>
                              <option value="Room 01">Dr Bial </option>
                              <option value="Room 02">Dr Kifayat</option>
                          </select>

                      <div class="mb-1">
                          <label for="event-url" class="form-label">Anesthetic</label>
                          <select class="select2 select-add-guests form-select w-100 select2-hidden-accessible" aria-hidden="true">
                              <option value="Room 01">-- Select --</option>
                              <option value="Room 01">Dr Kashif Anwar</option>
                              <option value="Room 02">Dr Izaz</option>
                              <option value="Room 03">Dr Kamran</option>
                              <option value="Room 04">Dr Sheeba</option>
                          </select>
                      </div>
                <div class="mb-1">
                  <label class="form-label">Description</label>
                  <textarea name="event-description-editor" id="event-description-editor" class="form-control"></textarea>
                </div>
                          <div class="mb-1">
                              <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">
                              <label class="form-check-label" for="inlineCheckbox1">Confirmed ?
                              </label>
                          </div>


                <div class="mb-1 d-flex">
                  <button type="submit" class="btn btn-primary add-event-btn me-1 waves-effect waves-float waves-light">Add</button>
                  <button type="button" class="btn btn-outline-secondary btn-cancel waves-effect" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary update-event-btn d-none me-1 waves-effect waves-float waves-light">Update</button>
                  <button class="btn btn-outline-danger btn-delete-event d-none waves-effect">Delete</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!--/ Calendar Add/Update/Delete event modal-->
    </section>
    <!-- Full calendar end -->

  </div>
</div>
@endsection
