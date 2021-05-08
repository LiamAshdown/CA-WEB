
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

/**
 * Generate UUID
 *
 * @returns {string}
 */
export const uuid = () => {
  return ([1e7] + -1e3 + -4e3 + -8e3 + -1e11).replace(/[018]/g, c =>
    (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16))
}

/**
 * Generate Random String
 *
 * @returns {string}
 */
export const randomString = () => {
  return Math.random().toString(36).substring(7)
}
