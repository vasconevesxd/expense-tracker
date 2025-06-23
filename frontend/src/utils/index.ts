export const toPascalCase = (text: string) => {
  return (text.match(/\w+/g) || [])
    .map(w => w[0].toUpperCase() + w.slice(1).toLowerCase())
    .join('')
}
