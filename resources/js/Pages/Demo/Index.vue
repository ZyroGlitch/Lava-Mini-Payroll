<script setup>
    import people from "../../../../data/mockDataPeople.json";
    import { ref, h } from "vue";
    import { format } from "date-fns";
    import EditButton from "./EditButton.vue";

    // Define Layouts
    defineOptions({
        layout: null,
    });

    // Tanstack Vue Table Properties
    import {
        useVueTable,
        FlexRender,
        getCoreRowModel,
        getPaginationRowModel,
        getSortedRowModel,
        getFilteredRowModel,
    } from "@tanstack/vue-table";

    const data = ref(people);
    const sorting = ref([]);
    const filter = ref("");

    // Table Header while chaining their column referrence
    const columnsPeople = [
        {
            accessorKey: "id",
            header: "ID",
            enableSorting: false, // Disable sorting for this column
        },
        // {
        //     accessorFn: (row) => `${row.last_name} ${row.first_name} `,
        //     header: "Full Name",
        // },
        {
            accessorKey: "first_name",
            header: "First Name",
        },
        {
            accessorKey: "last_name",
            header: "Last Name",
        },
        {
            accessorKey: "email",
            header: "Email",
        },
        {
            accessorKey: "title",
            header: "Title",
        },
        {
            accessorKey: "role",
            header: "Role",
        },
        {
            accessorKey: "created_at",
            header: "Created At",
            cell: (info) => format(new Date(info.getValue()), "MMM d, yyyy"),
        },
        {
            accessorKey: "edit",
            header: "Actions",
            cell: ({ row }) => h(EditButton, { id: row.original.id }),
            enableSorting: false, // Disable sorting for this column
        },
    ];

    const table = useVueTable({
        data: data.value,
        columns: columnsPeople,
        getCoreRowModel: getCoreRowModel(),
        getPaginationRowModel: getPaginationRowModel(), // Table Navigation
        getSortedRowModel: getSortedRowModel(), // Column Sorting
        getFilteredRowModel: getFilteredRowModel(), // Search Filter

        state: {
            // Column Sorting
            get sorting() {
                return sorting.value;
            },
            // Search Filter
            get globalFilter() {
                return filter.value;
            },
        },
        onSortingChange: (updaterOrValue) => {
            sorting.value = typeof updaterOrValue === "function" ? updaterOrValue(sorting.value) : updaterOrValue;
        },
    });
</script>

<template>
    <div class="px-4 sm:px-6 lg:px-8">
        <div class="mt-8 flow-root">
            <!-- Search Filter -->
            <div class="py-1">
                <input
                    class="border border-gray-300 rounded p-2"
                    placeholder="Search..."
                    v-model="filter"
                />
            </div>

            <!-- Pagination -->
            <div class="flex justify-between items-center py-4">
                <!-- Table Navigation -->
                <div class="space-x-4">
                    <button
                        class="border border-gray-300 rounded p-2"
                        @click="table.setPageIndex(0)"
                    >
                        First Page
                    </button>
                    <button
                        class="border border-gray-300 rounded p-2"
                        @click="table.setPageIndex(table.getPageCount() - 1)"
                    >
                        Last Page
                    </button>
                    <button
                        class="border border-gray-300 rounded p-2 disabled:opacity-50 disabled:cursor-not-allowed"
                        @click="table.previousPage()"
                        :disabled="!table.getCanPreviousPage()"
                    >
                        Previous Page
                    </button>
                    <button
                        class="border border-gray-300 rounded p-2 disabled:opacity-50 disabled:cursor-not-allowed"
                        @click="table.nextPage()"
                        :disabled="!table.getCanNextPage()"
                    >
                        Next Page
                    </button>
                </div>

                <!-- Filter Page Size -->
                <div class="space-x-4">
                    <button
                        class="border border-gray-300 rounded p-2"
                        @click="table.setPageSize(5)"
                    >
                        Page Size 5
                    </button>
                    <button
                        class="border border-gray-300 rounded p-2"
                        @click="table.setPageSize(10)"
                    >
                        Page Size 10
                    </button>
                    <button
                        class="border border-gray-300 rounded p-2"
                        @click="table.setPageSize(20)"
                    >
                        Page Size 20
                    </button>
                </div>

                <!-- Page Count -->
                <span class="ml-2">
                    Page {{ table.getState().pagination.pageIndex + 1 }} of {{ table.getPageCount() }} -
                    {{ table.getFilteredRowModel().rows.length }} results
                </span>
            </div>

            <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
                    <table class="min-w-full divide-y divide-gray-300">
                        <thead>
                            <tr
                                v-for="headerGroup in table.getHeaderGroups()"
                                :key="headerGroup.id"
                            >
                                <th
                                    v-for="header in headerGroup.headers"
                                    :key="header.id"
                                    scope="col"
                                    class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"
                                    :class="{ 'cursor-pointer select-none': header.column.getCanSort() }"
                                    @click="header.column.getToggleSortingHandler()?.($event)"
                                >
                                    <FlexRender
                                        :render="header.column.columnDef.header"
                                        :props="header.getContext()"
                                    />
                                    {{ { asc: "↑", desc: "↓" }[header.column.getIsSorted()] }}
                                </th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            <tr
                                v-for="row in table.getRowModel().rows"
                                :key="row.id"
                            >
                                <td
                                    v-for="cell in row.getVisibleCells()"
                                    :key="cell.id"
                                    class="whitespace-nowrap px-3 py-4 text-sm text-gray-500"
                                >
                                    <FlexRender
                                        :render="cell.column.columnDef.cell"
                                        :props="cell.getContext()"
                                    />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
