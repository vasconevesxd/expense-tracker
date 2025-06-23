import { useQuery } from '@tanstack/vue-query'
import { api } from '@/boot/axios'
import type { Expense } from '@/features/expenses/types'

export function getExpenses() {
  return useQuery({
    queryKey: ['expenses'],
    queryFn: async () => {
      const res = await api.get('/expenses')
      return res.data
    },
  })
}

export async function createExpense(expense: Expense) {
  const res = await api.post('/expenses', expense)
  return res.data
}

export async function updateExpense(expense: Expense) {
  const res = await api.put(`/expenses/${expense.id}`, expense)
  return res.data
}

export async function deleteExpense(id: number) {
  const res = await api.delete(`/expenses/${id}`)
  return res.data
}
