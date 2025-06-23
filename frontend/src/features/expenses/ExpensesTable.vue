<script lang="ts" setup>
  import type { Expense } from '@/features/expenses/types'

  defineProps<{ expenses: Expense[] }>()

  const emit = defineEmits<{ openDialog: [expense: Expense] }>()

  const columns = ref([
    {
      name: 'description',
      label: 'Description',
      field: 'description',
      align: 'left',
    },
    {
      name: 'category',
      label: 'Category',
      field: row => row.category.name,
      align: 'left',
      sortable: true,
    },
    {
      name: 'type',
      label: 'Type',
      field: row => row.expense_type.name,
      align: 'left',
      sortable: true,
    },
    {
      name: 'amount',
      label: 'Amount (€)',
      field: 'amount',
      align: 'right',
      sortable: true,
    },
    {
      name: 'date',
      label: 'Date',
      field: 'date',
      align: 'left',
      sortable: true,
    },
  ])
</script>

<template>
  <q-table
    :rows="expenses"
    :columns="columns"
    row-key="id"
    @row-click="(_, row) => emit('openDialog', row)"
  />
</template>
