wp.blocks.registerBlockType("ourblocktheme/events", {
  title: "Events",
  edit: function () {
    return wp.element.createElement(
      "div",
      { className: "events-block" },
      "Events Placeholder"
    );
  },
  save: function () {
    return null;
  },
});
