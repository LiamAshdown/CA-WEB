<template>
  <div>
    <bubble-menu
      class="bubble-menu"
      :tippy-options="{ duration: 100 }"
      :editor="editor"
      v-if="editor"
    >
      <button @click="editor.chain().focus().toggleBold().run()" :class="{ 'is-active': editor.isActive('bold') }">
        Bold
      </button>
      <button @click="editor.chain().focus().toggleItalic().run()" :class="{ 'is-active': editor.isActive('italic') }">
        Italic
      </button>
      <button @click="editor.chain().focus().toggleStrike().run()" :class="{ 'is-active': editor.isActive('strike') }">
        Strike
      </button>
    </bubble-menu>

    <editor-content :editor="editor" />
  </div>
</template>

<script>
import {
  Editor,
  EditorContent,
  BubbleMenu,
  FloatingMenu
} from '@tiptap/vue-2'
import { defaultExtensions } from '@tiptap/starter-kit'

export default {
  components: {
    EditorContent,
    BubbleMenu,
    FloatingMenu
  },

  name: 'BillDraftEditor',

  props: {
    value: {
      type: String,
      default: ''
    }
  },

  data () {
    return {
      editor: null
    }
  },

  watch: {
    value (value) {
      // HTML
      const isSame = this.editor.getHTML() === value

      if (isSame) {
        return
      }

      this.editor.commands.setContent(this.value, false)
    }
  },

  mounted () {
    this.editor = new Editor({
      extensions: [
        ...defaultExtensions()
      ],
      content: this.value,
      onUpdate: () => {
        // HTML
        this.$emit('input', this.editor.getHTML())
      }
    })
  },

  beforeDestroy () {
    this.editor.destroy()
  }
}
</script>

<style lang="scss">
.ProseMirror {
  > * + * {
    margin-top: 0.75em;
  }

  min-height: 40px !important;

  ul,
  ol {
    padding: 0 1rem;
  }

  blockquote {
    padding-left: 1rem;
    border-left: 2px solid rgba(#0D0D0D, 0.1);
  }
}

.bubble-menu {
  display: flex;
  background-color: #0D0D0D;
  padding: 0.2rem;
  border-radius: 0.5rem;

  button {
    border: none;
    background: none;
    color: #FFF;
    font-size: 0.85rem;
    font-weight: 500;
    padding: 0 0.2rem;
    opacity: 0.6;

    &:hover,
    &.is-active {
      opacity: 1;
    }
  }
}

.floating-menu {
  display: flex;
  background-color: #0D0D0D10;
  padding: 0.2rem;
  border-radius: 0.5rem;

  button {
    border: none;
    background: none;
    font-size: 0.85rem;
    font-weight: 500;
    padding: 0 0.2rem;
    opacity: 0.6;

    &:hover,
    &.is-active {
      opacity: 1;
    }
  }
}
</style>
