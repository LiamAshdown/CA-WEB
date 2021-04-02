
/**
 * Get Base URL
 *
 * @returns string
 */
export const baseURL = () => process.env.VUE_APP_BASE_URL

/**
 * Convert String to snake case
 *
 * @param {string} string
 * @returns {string}
 */
export const snakeCase = (string) => {
  return string.replace(/\d+/g, ' ')
    .split(/ |\B(?=[A-Z])/)
    .map((word) => word.toLowerCase())
    .join('_')
}
