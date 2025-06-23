import { useQuery } from '@tanstack/vue-query'
import { api } from '@/boot/axios'
import type { Category } from '@/features/categories/types'

export function getCategory() {
  return useQuery({
    queryKey: ['categories'],
    queryFn: async () => {
      const res = await api.get('/expense-categories')
      return res.data
    },
  })
}
export async function createCategory(category: Category) {
  const res = await api.post('/expense-categories', category)
  return res.data
}

export async function updateCategory(category: Category) {
  const res = await api.put(`/expense-categories/${category.id}`, category)
  return res.data
}

export async function deleteCategory(id: number) {
  const res = await api.delete(`/expense-categories/${id}`)
  return res.data
}
