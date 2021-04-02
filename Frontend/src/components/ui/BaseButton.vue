<template>
  <b-button
    v-if="loading"
    :block="block"
    variant="primary"
    :type="type"
    :disabled="loading"
    v-bind="$attrs"
  >
    <b-spinner small></b-spinner>
    <slot></slot>
    </b-button>
    <b-button
      v-else
      :block="block"
      :type="type"
      :variant="variant"
      v-bind="$attrs"
    >
  <slot></slot>
  </b-button>
</template>

<script>
/**
 * Base Button
 * @displayName Base Button
 */
export default {
  props: {
    /**
     * Type of Button
     */
    type: {
      type: String,
      required: false,
      default: 'submit'
    },
    /**
     * Colour Variant of Button
     */
    variant: {
      type: String,
      required: false,
      default: 'primary'
    },
    /**
     * Whether Button should fill 100% of parent width
     */
    block: {
      type: Boolean,
      required: false,
      default: false
    },
    /**
     * Button is loading
     */
    loading: {
      type: Boolean,
      required: false,
      default: false
    }
  }
}
</script>
