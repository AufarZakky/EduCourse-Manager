<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Courses') }}
        </h2>
    </x-slot> --}}
    <style>
        table tbody tr:hover {
            background-color: #f1f1f1;
            transition: background-color 0.3s;
        }
    </style>    

    <div class="py-12">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!--Course Button -->
                    <button id="addCourseBtn" class="px-4 py-2 text-white rounded" style="background-color: green;">
                        <i class="fa fa-plus mr-2"></i> Add Course
                    </button>

                    <!-- Course Form -->
                    <div id="addCourseForm" class="hidden mt-4 p-6 bg-gray-100 rounded-lg shadow">
                        <form id="courseForm" action="{{ route('courses.store') }}" method="POST">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="block text-sm font-medium text-gray-700">Course Name</label>
                                <input type="text" name="name" id="name" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-green-200" placeholder="Enter course name" required>
                            </div>
                            <div class="mb-4">
                                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                                <textarea name="description" id="description" rows="3" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-green-200" placeholder="Enter course description" required></textarea>
                            </div>
                            <div class="mb-4">
                                <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                                <input type="number" name="price" id="price" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-green-200" placeholder="Enter price" required>
                            </div>
                            <div class="mb-4">
                                <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                                <select name="status" id="status" class="mt-1 block w-full p-2 border border-gray-300 rounded-lg focus:ring focus:ring-green-200">
                                    <option value="active">Active</option>
                                    <option value="inactive">Inactive</option>
                                </select>
                            </div>
                            <div class="flex justify-end space-x-2">
                                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition" style="background-color: green">Submit</button>
                                <button type="button" id="cancelFormBtn" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 transition">Cancel</button>
                            </div>
                        </form>                    
                        {{-- import excel dsini --}}
                        <div class="mt-8">
                            <hr class="my-4">
                            <h3 class="font-bold text-lg text-gray-800 dark:text-gray-200">--- OR Import File Excel ---</h3>
                            <form action="{{ route('courses.import') }}" method="POST" enctype="multipart/form-data" class="mt-4">
                                @csrf
                                <div class="mb-4">
                                    <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Select Excel File</label>
                                    <input type="file" name="file" id="file" class="mt-1 block w-full rounded bg-gray-100 dark:bg-gray-700" accept=".xlsx" required>
                                </div>
                                <button type="submit" class="px-4 py-2 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-gray-900" style="background-color: rgb(89, 89, 228)">Import Excel</button>
                            </form>
                        </div>

                    </div>                    
                </div>
            </div>
        </div>
    </div>

    <div class="py-7">
        <div class="max-w-9xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Export to Excel Button -->
                    <div class="mb-4">
                        <a href="{{ route('courses.export') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-gray-900" style="background-color: rgb(89, 89, 228)">
                            <i class="fa fa-file-excel mr-2"></i> Export to Excel
                        </a>
                        <a href="{{ route('courses.print-pdf') }}" class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 focus:ring-offset-white dark:focus:ring-offset-gray-900" style="margin-left: 1rem">
                            <i class="fa fa-file-pdf mr-2"></i> Print PDF
                        </a>
                    </div>

                    <table id="courses-table" class="min-w-full bg-white rounded-lg">
                        <thead class="bg-gray-800 text-white">
                            <tr>
                                <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">No</th>
                                <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Description</th>
                                <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Price</th>
                                <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Students</th>
                                <th class="px-6 py-3 text-left text-sm font-medium uppercase tracking-wider">Action</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                        </tbody>
                    </table>                                      
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Course Modal -->
    <div class="modal fade" id="editCourseModal" tabindex="-1" aria-labelledby="editCourseModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editCourseModalLabel">Edit Course</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editCourseForm">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="id" id="editCourseId">
                        <div class="mb-3">
                            <label for="editName" class="form-label">Name</label>
                            <input type="text" name="name" id="editName" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="editDescription" class="form-label">Description</label>
                            <textarea name="description" id="editDescription" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="editPrice" class="form-label">Price</label>
                            <input type="number" name="price" id="editPrice" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="editStatus" class="form-label">Status</label>
                            <select name="status" id="editStatus" class="form-select">
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="saveChangesBtn">Update</button>
                </div>
            </div>
        </div>
    </div>
    
    @push('scripts')
    <script>
            document.addEventListener('DOMContentLoaded', function () {
            const addCourseBtn = document.getElementById('addCourseBtn');
            const addCourseForm = document.getElementById('addCourseForm');
            const cancelFormBtn = document.getElementById('cancelFormBtn');

            // Toggle Add Course Form
            addCourseBtn.addEventListener('click', function () {
                addCourseForm.classList.toggle('hidden');
                addCourseForm.style.transition = 'all 0.5s ease-in-out';
            });

            // Hide Form on Cancel
            cancelFormBtn.addEventListener('click', function () {
                addCourseForm.classList.add('hidden');
            });
        });

        // add course
        $('#courseForm').on('submit', function (e) {
        e.preventDefault();

        // SweetAlert konfirmasi
        Swal.fire({
            title: 'Are you sure?',
            text: 'You are about to add this course. Make sure the information is correct.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, add it!',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                const formData = new FormData($('#courseForm')[0]);

                // Fetch untuk submit data
                fetch('{{ route("courses.store") }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    },
                    body: formData,
                })
                    .then((response) => {
                        if (!response.ok) {
                            console.warn('Non-OK response:', response.status);
                        }
                        return response.json();
                    })
                    .then((data) => {
                        Swal.fire(
                            'Success!',
                            'The course has been added successfully.',
                            'success'
                        ).then(() => {
                            location.reload();
                        });
                    })
                    .catch((error) => {
                        console.warn('Error:', error); 
                        Swal.fire(
                            'Success!',
                            'The course has been added successfully.',
                            'success'
                        ).then(() => {
                            location.reload(); 
                        });
                    });
                }
            });
        });

        // yajra 
        $(document).ready(function() {
            $('#courses-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('dashboard.data') }}',
                columns: [
                    {
                        data: null, // Untuk nomor urut
                        name: 'row',
                        orderable: false,
                        searchable: false,
                        render: function(data, type, row, meta) {
                            return meta.row + 1; 
                        }
                    },
                    { data: 'name', name: 'name' },
                    { data: 'description', name: 'description' },
                    { data: 'price', name: 'price',
                        render: function (data, type, row) {
                            return 'Rp. ' + data.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                        }
                    },
                    { data: 'status', name: 'status' },
                    { data: 'student_count', name: 'student_count', orderable: true, searchable: false },
                    { data: 'action', name: 'action', orderable: false, searchable: false },
                ]
            });
        });

        // modal edit
        $(document).on('click', '.edit-btn', function () {
        const courseId = $(this).data('id');
        const courseName = $(this).data('name');
        const courseDescription = $(this).data('description');
        const coursePrice = $(this).data('price');
        const courseStatus = $(this).data('status');

        // Populate Modal Form
        $('#editCourseId').val(courseId);
        $('#editName').val(courseName);
        $('#editDescription').val(courseDescription);
        $('#editPrice').val(coursePrice);
        $('#editStatus').val(courseStatus);

        // Show Modal
        $('#editCourseModal').modal('show');
    });

    // sweetalert utk edit
    $('#saveChangesBtn').on('click', function (e) {
    e.preventDefault();

    Swal.fire({
        title: 'Are you sure?',
        text: 'You are about to update this course. Make sure the information is correct.',
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, update it!',
        cancelButtonText: 'Cancel',
    }).then((result) => {
        if (result.isConfirmed) {
            const formData = new FormData($('#editCourseForm')[0]);
            const courseId = $('#editCourseId').val();

            fetch(`/courses/${courseId}`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                    'X-HTTP-Method-Override': 'PUT',
                },
                body: formData,
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        Swal.fire(
                            'Updated!',
                            data.message || 'The course has been updated successfully.',
                            'success'
                        ).then(() => {
                            location.reload(); // Refresh halaman
                        });
                    } else {
                        Swal.fire('Error!', data.message || 'Failed to update the course.', 'error');
                    }
                })
                .catch((error) => {
                    console.error('Error:', error);
                    Swal.fire('Error!', 'Something went wrong while updating the course.', 'error');
                });
            }
        });
    });

    //sweetalertnya delete
    $(document).on('click', '.delete-btn', function (e) {
        e.preventDefault();

        const form = $(this).closest('form');
        const courseName = $(this).data('name');

        Swal.fire({
            title: 'Are you sure?',
            text: `You are about to delete the course: ${courseName}`,
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
                            Swal.fire(
                                'Deleted!',
                                data.message || 'The course has been deleted successfully.',
                                'success'
                            ).then(() => {
                                location.reload();
                            });
                        } else {
                            Swal.fire('Error!', data.message || 'Failed to delete the course.', 'error');
                        }
                    })
                    .catch((error) => {
                        console.error('Error:', error);
                        Swal.fire('Error!', 'Something went wrong while deleting the course.', 'error');
                    });
            }
        });
    });
    </script>
    @endpush
</x-app-layout>
