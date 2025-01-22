<x-app-layout>
    <style>
        table tbody tr:hover {
            background-color: #f1f1f1;
            transition: background-color 0.3s;
        }
    </style>
    <div class="py-12">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Success Message -->
                    {{-- @if (session('success'))
                        <div class="mb-4 text-green-500">
                            {{ session('success') }}
                        </div>
                    @endif --}}

                    <!-- Add Student Button -->
                    <button id="addStudentBtn" class="px-4 py-2 text-white rounded" style="background-color: green;">
                        <i class="fa fa-plus mr-2"></i> Add Student
                    </button>

                    <!-- Add Transaction Form -->
                    <div id="addStudentForm" class="hidden mt-4 p-6 bg-gray-100 rounded-lg shadow">
                        <form id="studentForm" action="{{ route('transactions.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="student_name" class="block text-sm font-medium text-gray-700">Student Name</label>
                                <input type="text" name="student_name" id="student_name" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-green-200" placeholder="Enter student name" required>
                            </div>
                            <div class="mb-4">
                                <label for="course_id" class="block text-sm font-medium text-gray-700">Course</label>
                                <select name="course_id" id="course_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-green-200" required>
                                    <option value="">Select a Course</option>
                                    @foreach ($courses as $course)
                                        <option value="{{ $course->id }}" data-price="{{ $course->price }}">{{ $course->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-4">
                                <label for="course_price" class="block text-sm font-medium text-gray-700">Course Price</label>
                                <input type="text" id="course_price" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg bg-gray-100" readonly>
                            </div>
                            <div class="mb-4">
                                <label for="enrollment_date" class="block text-sm font-medium text-gray-700">Enrollment Date</label>
                                <input type="date" name="enrollment_date" id="enrollment_date" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-green-200" required>
                            </div>
                            <div class="mb-4">
                                <label for="payment_status" class="block text-sm font-medium text-gray-700">Payment Status</label>
                                <select name="payment_status" id="payment_status" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-green-200" required>
                                    <option value="paid">Paid</option>
                                    <option value="unpaid">Unpaid</option>
                                </select>
                            </div>
                            <div class="flex justify-end space-x-2">
                                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition btn btn-success">
                                    Submit
                                </button>
                                <button type="button" id="cancelStudentFormBtn" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="mt-4 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Filter by Course -->
                    <div class="mb-4">
                        <label for="filter_course" class="block text-sm font-medium text-gray-700">Filter by Course</label>
                        <select id="filter_course" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-green-200">
                            <option value="">All Courses</option>
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}">{{ $course->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Transactions Table -->
                    <table id="transactions-table" class="min-w-full bg-white rounded-lg ">
                        <thead class="bg-gray-800 text-white">
                           <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Student Name</th>
                                <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Course</th>
                                <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Enrollment Date</th>
                                <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Payment Status</th>
                                <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200"></tbody>
                    </table>
                </div>
            </div>

            <!-- Edit Transaction Modal -->
            <div class="modal fade" id="editTransactionModal" tabindex="-1" aria-labelledby="editTransactionModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editTransactionModalLabel">Edit Transaction</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form id="editTransactionForm">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="id" id="editTransactionId">
                                <div class="mb-3">
                                    <label for="editStudentName" class="form-label">Student Name</label>
                                    <input type="text" name="student_name" id="editStudentName" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editCourseId" class="form-label">Course</label>
                                    <select name="course_id" id="editCourseId" class="form-select" required>
                                        @foreach ($courses as $course)
                                            <option value="{{ $course->id }}">{{ $course->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="editEnrollmentDate" class="form-label">Enrollment Date</label>
                                    <input type="date" name="enrollment_date" id="editEnrollmentDate" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="editPaymentStatus" class="form-label">Payment Status</label>
                                    <select name="payment_status" id="editPaymentStatus" class="form-select" required>
                                        <option value="paid">Paid</option>
                                        <option value="unpaid">Unpaid</option>
                                    </select>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-primary" id="saveTransactionChanges">Update</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const addStudentBtn = document.getElementById('addStudentBtn');
            const addStudentForm = document.getElementById('addStudentForm');
            const cancelStudentFormBtn = document.getElementById('cancelStudentFormBtn');

            // Toggle Add Student Form
            addStudentBtn.addEventListener('click', function () {
                addStudentForm.classList.toggle('hidden');
                addStudentForm.style.transition = 'all 0.5s ease-in-out';
            });

            // Hide Form on Cancel
            cancelStudentFormBtn.addEventListener('click', function () {
                addStudentForm.classList.add('hidden');
            });
        });

        // tampilan hrga sesuai course
        document.addEventListener('DOMContentLoaded', function () {
            const courseDropdown = document.getElementById('course_id');
            const priceField = document.getElementById('course_price');

            courseDropdown.addEventListener('change', function () {
                const selectedOption = courseDropdown.options[courseDropdown.selectedIndex];
                const price = selectedOption.getAttribute('data-price') || '';
                priceField.value = price ? `Rp. ${price.replace(/\B(?=(\d{3})+(?!\d))/g, '.')}` : '';
            });
        });

        // SweetAlert untuk Submit
        $('#studentForm').on('submit', function (e) {
            e.preventDefault(); // Mencegah default form submission

            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to add this student. Make sure the information is correct.',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, add it!',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    const formData = new FormData($('#studentForm')[0]);

                    fetch('{{ route("transactions.store") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        },
                        body: formData,
                    })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                Swal.fire(
                                    'Added!',
                                    'Student has been added successfully.',
                                    'success'
                                ).then(() => {
                                    location.reload();
                                });
                            } else {
                                Swal.fire('Error!', data.message || 'Failed to add student.', 'error');
                            }
                        })
                        .catch((error) => {
                        console.warn('Error:', error); 
                        Swal.fire(
                            'Success!',
                            'Student has been added successfully.',
                            'success'
                        ).then(() => {
                            location.reload(); 
                        });
                    });
                }
            });
        });

        $(document).ready(function () {
        // Initialize Yajra DataTable
        const table = $('#transactions-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: '{{ route('transactions.data') }}',
                data: function (d) {
                    d.course_id = $('#filter_course').val();
                },
            },
            columns: [
                {
                    data: null,
                    name: 'row',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row, meta) {
                        return meta.row + 1;
                    },
                },
                { data: 'student_name', name: 'student_name' },
                { data: 'course_name', name: 'course_name' },
                { data: 'enrollment_date', name: 'enrollment_date' },
                { data: 'payment_status', name: 'payment_status' },
                { data: 'action', name: 'action', orderable: false, searchable: false },
            ],
        });

        // Filter Table by Course
        $('#filter_course').on('change', function () {
            table.ajax.reload();
        });

        // Handle Delete with SweetAlert
        $(document).on('click', '.delete-btn', function (e) {
            e.preventDefault();

            const form = $(this).closest('form');
            const studentName = $(this).data('student-name');

            Swal.fire({
                title: 'Are you sure?',
                text: `You are about to delete the transaction for ${studentName}.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel',
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(form.attr('action'), {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                            'X-HTTP-Method-Override': 'DELETE',
                        },
                    })
                        .then((response) => response.json())
                        .then((data) => {
                            if (data.success) {
                                Swal.fire('Deleted!', data.message || 'Transaction has been deleted.', 'success').then(() => {
                                    table.ajax.reload();
                                });
                            } else {
                                Swal.fire('Error!', data.message || 'Failed to delete the transaction.', 'error');
                            }
                        })
                        .catch((error) => {
                            console.error(error);
                            Swal.fire('Error!', 'Something went wrong while deleting the transaction.', 'error');
                        });
                }
            });
        });
    });


        $(document).on('click', '.edit-btn', function () {
            // Ambil data dari atribut tombol
            const transactionId = $(this).data('id');
            const studentName = $(this).data('student-name');
            const courseId = $(this).data('course-id');
            const enrollmentDate = $(this).data('enrollment-date');
            const paymentStatus = $(this).data('payment-status');

            // Isi modal dengan data
            $('#editTransactionId').val(transactionId);
            $('#editStudentName').val(studentName);
            $('#editCourseId').val(courseId);
            $('#editEnrollmentDate').val(enrollmentDate);
            $('#editPaymentStatus').val(paymentStatus);

            // Tampilkan modal
            $('#editTransactionModal').modal('show');
        });

    $('#saveTransactionChanges').on('click', function (e) {
        e.preventDefault();

        const transactionId = $('#editTransactionId').val();
        const formData = new FormData($('#editTransactionForm')[0]);

        fetch(`/transactions/${transactionId}`, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'X-HTTP-Method-Override': 'PUT',
            },
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                $('#editTransactionModal').modal('hide');
                $('#transactions-table').DataTable().ajax.reload();

                Swal.fire('Updated!', 'Transaction has been updated.', 'success');
            } else {
                Swal.fire('Error!', 'Failed to update transaction.', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire('Error!', 'Something went wrong.', 'error');
        });
    });
    </script>
    @endpush
</x-app-layout>
