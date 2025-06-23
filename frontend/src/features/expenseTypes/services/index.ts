import { useMutation, useQuery } from '@tanstack/vue-query'
import { api } from '@/boot/axios'

export function getExpenseTypes() {
  return useQuery({
    queryKey: ['expense-types'],
    queryFn: async () => {
      const res = await api.get('/expense-types')
      return res.data
    },
  })
}

export function updateExpenseTypes(expenseTypes: Category) {
  return useMutation({
    mutationFn: async () => {
      const res = await api.put(
        `/expense-types/${expenseTypes.id}`,
        expenseTypes
      )
      return res.data
    },
  })
}

export function deleteExpenseTypes(id: number) {
  return useMutation({
    mutationFn: async () => {
      const res = await api.delete(`/expense-types/${id}`)
      return res.data
    },
  })
}
