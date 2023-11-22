@extends('partials.app')
@push('style')
    <style>
        .text-small {
            font-size: smaller;
        }

        .nowrap {
            white-space: nowrap;
        }
    </style>
@endpush
@section('content')
    <div class="card">
        <div class="card-header text-center">
            <h4>Table {{ $title ?? '' }}</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive nowrap">
                <div class="row">
                    <div class="col-md-9">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addModal">
                            <i class="fas fa-plus mr-2"></i> Add {{ $title ?? '' }}
                        </button>
                    </div>
                    <div class="col-md-3">
                        <div class="input-group mb-3 d-flex justify-content-end">
                            <input type="text" class="form-control" placeholder="Search" aria-label="Search"
                                aria-describedby="basic-addon2" id="search_table">
                            <div class="input-group-append">
                                <button class="input-group-text"id="searchBtn"><i class="fas fa-search"></i></button>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-striped">

                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">
                                Email
                                <input type="email" name="email" class="form-control form-control-sm" id="inp_email">
                                <span class="text-info text-sm">Enter to search</span>
                            </th>
                            <th scope="col">
                                Phone
                                <input type="text" name="phone" class="form-control form-control-sm" id="inp_phone">
                                <span class="text-info text-sm">Enter to search</span>

                            </th>
                            <th scope="col">
                                Fullname
                                <input type="text" name="fullname" class="form-control form-control-sm"
                                    id="inp_fullname">
                                <span class="text-info text-sm">Enter to search</span>

                            </th>
                            <th scope="col">
                                Date of birth
                                <input type="date" name="dob" class="form-control form-control-sm" id="inp_dob">
                                <span class="text-info text-sm">Select to search</span>

                            </th>
                            <th scope="col">
                                Place of birth
                                <input type="text" name="pob" class="form-control form-control-sm" id="inp_pob">
                                <span class="text-info text-sm">Enter to search</span>

                            </th>
                            <th scope="col">
                                Gender
                                <select name="gender" id="inp_gender" class="form-control form-control-sm">
                                    <option value="all">All</option>
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                                <span class="text-info text-sm">Select to search</span>

                            </th>
                            <th scope="col">
                                Experience
                                <input type="number" name="year_exp" class="form-control form-control-sm" id="inp_year">
                                <span class="text-info text-sm">Type to search</span>
                            </th>
                            <th scope="col">
                                Last Salary
                                <input type="number" class="form-control form-control-sm" id="inp_salary">
                                <span class="text-info text-sm">Enter to search</span>
                            </th>
                            <th style="width: 130px" class="text-center mb-5">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody id="table">
                    </tbody>
                </table>
                <div class="row">
                    <div class="col  mt-5 d-flex justify-content-start text-secondary">
                        Items Per Page <select id="pagination" class="form-control form-control-sm ml-2 mr-2"
                            style="width: 60px">
                            <option value="5" id="num-5">5</option>
                            <option value="10" id="num-10">10</option>
                            <option value="20" id="num-20">20</option>
                            <option value="40" id="num-40">40</option>
                            <option value="50" id="num-50">50</option>
                            <option value="100" id="num-100">100</option>
                        </select> <span id="paginationInfo">1-20 of 5000 items</span>
                    </div>
                    <div class="col mt-5 d-flex justify-content-end">
                        <input type="hidden" id="prevUrlInp">
                        <input type="hidden" id="nextUrlInp">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination" id="pageNumbers">

                                {{-- <li class="page-item pages" id="page-2"><a class="page-link" href="#">2</a></li>
                            <li class="page-item pages" id="page-3"><a class="page-link" href="#">3</a></li> --}}

                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Modal -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add {{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="formAdd">
                    <div class="modal-body">
                        <div class="alert alert-warning alert-dismissible fade show d-none" role="alert"
                            id="errorInfo">
                            <strong>Validation Error!</strong>
                            <p class="textInfo"></p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Email<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="email"
                                            placeholder="ufderhar@example.net">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Phone<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="phone_number"
                                            placeholder="(425) 703-9905">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Fullname<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="full_name"
                                            placeholder="Jhon Doe">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Date of birth<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" name="dob"
                                            placeholder="02/02/1976">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Place of birth<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="pob"
                                            placeholder="Maldives">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Gender<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <select name="gender" class="form-control">
                                            <option selected disabled>-Select</option>
                                            <option value="F">Female</option>
                                            <option value="M">Male</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Year experience<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="year_exp" placeholder="1">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Last salary</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="last_salary"
                                            placeholder="0,000,000">
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Add Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog  modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit {{ $title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form id="formUpdate">
                    <div class="modal-body">
                        <div class="alert alert-warning alert-dismissible fade show d-none" role="alert"
                            id="errorInfoUpdate">
                            <strong>Validation Error!</strong>
                            <p class="textInfo"></p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="row">
                            <input type="hidden" name="candidate_id" id="up_id">
                            <div class="col">
                                <div class="form-group row">
                                    <label for="staticEmail" class="col-sm-4 col-form-label">Email<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="email"
                                            placeholder="ufderhar@example.net" id="up_email">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Phone<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="phone_number"
                                            placeholder="(425) 703-9905" id="up_phone">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Fullname<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="full_name"
                                            placeholder="Jhon Doe" id="up_name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Date of birth<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="date" class="form-control" name="dob"
                                            placeholder="02/02/1976" id="up_dob">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Place of birth<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="text" class="form-control" name="pob" placeholder="Maldives"
                                            id="up_pob">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Gender<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <select name="gender" class="form-control" id="up_gender">
                                            <option selected disabled>-Select</option>
                                            <option value="F">Female</option>
                                            <option value="M">Male</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Year experience<span
                                            class="text-danger">*</span></label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="year_exp" placeholder="1"
                                            id="up_year">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword" class="col-sm-4 col-form-label">Last salary</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control" name="last_salary"
                                            placeholder="0,000,000" id="up_sal">
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('script')
    {{-- script table and pagination --}}
    <script>
        $(document).ready(function() {
            loadCandidates();
        });

        function loadCandidates(url = null) {
            var url = url != null ? url : '/api/v1/candidate';
            $.ajax({
                url: url,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    displayPagination(response.pages);
                    displayCandidates(response.pages);
                },
                error: function(error) {
                    console.error('Error loading candidates:', error);
                }
            });
        }

        function displayPagination(candidate) {
            var page = '';
            $.each(candidate.links, function(index, data) {
                var active = data.active == true ? 'active' : '';
                var disabled = data.url === null ? 'disabled' : '';
                page +=
                    `<li class="page-item ${active + ' '+disabled}"><a class="page-link" href="${data.url}">${data.label}</a></li>`
            });

            $('#pageNumbers').html(page);
            $(`#pagination`).val(candidate.per_page)
            $('#paginationInfo').html(`${candidate.from??0} - ${candidate.to??0} of ${candidate.total} items`)


        }

        function displayCandidates(candidates) {
            var html = '';
            if (candidates.total > 0) {
                $.each(candidates.data, function(index, candidate) {
                    html += '<tr>';
                    html += '<th>' + (candidates.from++) + '</th>';
                    html += '<td>' + candidate.email + '</td>';
                    html += '<td>' + candidate.phone_number + '</td>';
                    html += '<td>' + candidate.full_name + '</td>';
                    html += '<td>' + formatDate(candidate.dob) + '</td>';
                    html += '<td>' + candidate.pob + '</td>';
                    html += '<td>' + (candidate.gender == 'M' ? 'Male' : 'Female') + '</td>';
                    html += '<td>' + candidate.year_exp + ' Years' + '</td>';
                    html += '<td>' + (parseInt(candidate.last_salary).toLocaleString()) + '</td>';
                    html += `<td>
                            <btn class="btn btn-warning btn-sm mr-2 btnEdit" 
                            data-id="${candidate.candidate_id}"
                            data-email="${candidate.email}"
                            data-phone="${candidate.phone_number}"
                            data-name="${candidate.full_name}"
                            data-dob="${candidate.dob}"
                            data-pob="${candidate.pob}"
                            data-gender="${candidate.gender}"
                            data-year_exp="${candidate.year_exp}"
                            data-salary="${candidate.last_salary}"
                            data-toggle="modal" data-target="#editModal">
                            <i class="fas fa-edit mr-1"></i> Edit</btn>

                            <btn class="btn btn-danger btn-sm btnDelete"
                            data-id="${candidate.candidate_id}"
                            >Delete</btn> 
                        </td>`;
                    html += '</tr>';
                });
            } else {
                html += '<tr><td colspan="10" class="text-center">Empty Tables</td></tr>'
            }


            let active = candidates.current_page;
            let prev = candidates.prev_page_url;
            let next = candidates.next_page_url;

            if (prev === null) {
                $('#prevBtn').addClass('disabled');
            } else {
                $('#prevBtn').removeClass('disabled');
                $('#prevUrlInp').val(candidates.prev_page_url);
            }
            if (next === null) {
                $('#nextBtn').addClass('disabled');
            } else {
                $('#nextBtn').removeClass('disabled');
                $('#nextUrlInp').val(candidates.next_page_url);
            }
            $('.pages').removeClass('active')
            $(`#page-${active}`).addClass('active');
            $('#table').html(html);


        }
        $('#pageNumbers').on('click', '.page-link', function(e) {
            e.preventDefault();
            var linkHref = $(this).attr('href');
            loadCandidates(linkHref);
        });

        function formatDate(date) {
            var date = new Date(date);

            // Get day, month, and year components from the date
            var day = date.getDate();
            var month = date.getMonth() + 1; // Months are zero-based
            var year = date.getFullYear();

            // Add leading zeros if needed
            day = day < 10 ? '0' + day : day;
            month = month < 10 ? '0' + month : month;

            // Construct the formatted date string
            var formattedDate = day + '/' + month + '/' + year;

            return formattedDate;
        }
        $('#searchBtn').on('click', function() {
            const search = encodeURIComponent($('#search_table').val());
            $.ajax({
                url: `/api/v1/candidate?search=${search}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    displayCandidates(response.pages);
                },
                error: function(error) {
                    console.error('Error loading candidates:', error);
                }
            });
        })
        $('#pagination').on('change', function(e) {
            const page = encodeURIComponent($(this).val());
            $.ajax({
                url: `/api/v1/candidate?paginate=${page}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    displayCandidates(response.pages);
                },
                error: function(error) {
                    console.error('Error loading candidates:', error);
                }
            });
        })
        $('#inp_email').on('keypress', function() {
            const email = $(this).val();
            $.ajax({
                url: `/api/v1/candidate?email=${email}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    displayCandidates(response.pages);
                },
                error: function(error) {
                    console.error('Error loading candidates:', error);
                }
            });
        });
        $('#inp_phone').on('keypress', function() {
            const phone = encodeURIComponent($(this).val());
            $.ajax({
                url: `/api/v1/candidate?phone=${phone}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    displayCandidates(response.pages);
                },
                error: function(error) {
                    console.error('Error loading candidates:', error);
                }
            });
        })
        $('#inp_fullname').on('keypress', function() {
            const fullname = encodeURIComponent($(this).val());
            $.ajax({
                url: `/api/v1/candidate?fullname=${fullname}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    displayCandidates(response.pages);
                },
                error: function(error) {
                    console.error('Error loading candidates:', error);
                }
            });
        })
        $('#inp_dob').on('change', function() {
            const dob = encodeURIComponent($(this).val());
            $.ajax({
                url: `/api/v1/candidate?dob=${dob}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    displayCandidates(response.pages);
                },
                error: function(error) {
                    console.error('Error loading candidates:', error);
                }
            });
        });

        $('#inp_pob').on('keypress', function() {
            const pob = encodeURIComponent($(this).val());
            $.ajax({
                url: `/api/v1/candidate?pob=${pob}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    displayCandidates(response.pages);
                },
                error: function(error) {
                    console.error('Error loading candidates:', error);
                }
            });
        });
        $('#inp_gender').on('change', function() {
            const gender = encodeURIComponent($(this).val());
            $.ajax({
                url: `/api/v1/candidate?gender=${gender}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    displayCandidates(response.pages);
                },
                error: function(error) {
                    console.error('Error loading candidates:', error);
                }
            });
        })
        $('#inp_year').on('keyup', function() {
            const year_exp = encodeURIComponent($(this).val());
            $.ajax({
                url: `/api/v1/candidate?year_exp=${year_exp}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    displayCandidates(response.pages);
                },
                error: function(error) {
                    console.error('Error loading candidates:', error);
                }
            });
        });
        $('#inp_salary').on('keypress', function() {
            const salary = encodeURIComponent($(this).val());
            $.ajax({
                url: `/api/v1/candidate?salary=${salary}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    displayCandidates(response.pages);
                },
                error: function(error) {
                    console.error('Error loading candidates:', error);
                }
            });
        });
    </script>
    {{-- CRUD script --}}
    <script>
        $(document).ready(function() {
            $('#formAdd').on('submit', function(e) {
                e.preventDefault();
                var data = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: '/api/v1/candidate',
                    data: $(this).serialize(),
                    success: function(response) {
                        // Handle the success response
                        alert('Form submitted successfully!', response.message);
                        $('#addModal').modal('toggle');

                        $('#formAdd').trigger("reset");
                        loadCandidates();
                        $('#errorInfo').addClass('d-none');

                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            // Handle 422 response here
                            var errorMessages = '';
                            $.each(xhr.responseJSON.errors, function(field, messages) {
                                errorMessages += '<b>' + field + '</b>' + ': ' +
                                    messages.join(', ') +
                                    '<br>';
                            });
                            $('#errorInfo').removeClass('d-none');
                            $('.textInfo').html(errorMessages);
                        } else {
                            // Handle other error statuses
                            console.log('Unprocessable Content (422):', xhr.responseJSON);
                        }
                    }
                });
            });
            $('#table').on('click', '.btnEdit', function() {
                const id = $(this).data('id')
                const email = $(this).data('email')
                const phone = $(this).data('phone')
                const name = $(this).data('name')
                const dob = $(this).data('dob')
                const pob = $(this).data('pob')
                const gender = $(this).data('gender')
                const year = $(this).data('year_exp')
                const up_sal = $(this).data('salary')

                $('#up_id').val(id);
                $('#up_email').val(email);
                $('#up_phone').val(phone);
                $('#up_name').val(name);
                $('#up_dob').val(dob);
                $('#up_pob').val(pob);
                $('#up_gender').val(gender);
                $('#up_year').val(year);
                $('#up_sal').val(up_sal);
            })
            $('#formUpdate').on('submit', function(e) {
                e.preventDefault();
                var id = $('#up_id').val();
                var data = $(this).serialize();
                $.ajax({
                    type: 'PUT',
                    url: `/api/v1/candidate/${id}`,
                    data: $(this).serialize(),
                    success: function(response) {
                        // Handle the success response
                        alert(response.message);
                        $('#editModal').modal('toggle');

                        $('#formUpdate').trigger("reset");
                        loadCandidates();
                        $('#errorInfoUpdate').addClass('d-none');

                    },
                    error: function(xhr, status, error) {
                        if (xhr.status === 422) {
                            // Handle 422 response here
                            var errorMessages = '';
                            $.each(xhr.responseJSON.errors, function(field, messages) {
                                errorMessages += '<b>' + field + '</b>' + ': ' +
                                    messages.join(', ') +
                                    '<br>';
                            });
                            $('#errorInfoUpdate').removeClass('d-none');
                            $('.textInfo').html(errorMessages);
                        } else {
                            // Handle other error statuses
                            console.log('Unprocessable Content (422):', xhr.responseJSON);
                        }
                    }
                });
            });
            $('#table').on('click', '.btnDelete', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                $.ajax({
                    type: 'DELETE',
                    url: `/api/v1/candidate/${id}`,
                    success: function(response) {
                        // Handle the success response
                        alert(response.message);
                        loadCandidates();

                    },
                    error: function(xhr, status, error) {
                        console.log('ERROR:', xhr.responseJSON);
                    }
                });
            })

        });
    </script>
@endpush
