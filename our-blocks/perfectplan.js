import { InnerBlocks } from "@wordpress/block-editor";

wp.blocks.registerBlockType("ourblocktheme/perfectplan", {
  title: "Perfect Plan",
  supports: {
    align: ["full"],
  },
  attributes: {
    align: { type: "string", default: "full" },
  },
  edit: editComponent,
  save: saveComponent,
});

function editComponent() {
  return (
    <div
      style={{
        backgroundColor: "#efefef",
        padding: "30px",
        textAlign: "center",
        fontSize: "1.65rem",
      }}
    >
      <InnerBlocks />
    </div>
  );
}

function saveComponent() {
  return <InnerBlocks.Content />;
}
