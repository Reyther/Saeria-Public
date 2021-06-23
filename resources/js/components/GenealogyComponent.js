import dTree from 'd3-dtree';

const GenealogyComponent = {
  init: function () {
    // TODO: Use dynamic data
    const treeData = [
      {
        name: 'Alma',
        class: 'woman',
        textClass: 'emphasis',
        marriages: [
          {
            spouse: {
              name: 'Iliana',
              class: 'woman',
              extra: {
                nickname: 'Illi',
              },
            },
            children: [
              {
                name: 'James',
                class: 'man',
                marriages: [
                  {
                    spouse: {
                      name: 'Alexandra',
                      class: 'woman',
                    },
                    children: [
                      {
                        name: 'Eric',
                        class: 'man',
                        marriages: [
                          {
                            spouse: {
                              name: 'Eva',
                              class: 'woman',
                            },
                          },
                        ],
                      },
                      {
                        name: 'Jane',
                        class: 'woman',
                      },
                      {
                        name: 'Jasper',
                        class: 'man',
                      },
                      {
                        name: 'Emma',
                        class: 'woman',
                      },
                      {
                        name: 'Julia',
                        class: 'woman',
                      },
                      {
                        name: 'Jessica',
                        class: 'woman',
                      },
                    ],
                  },
                ],
              },
            ],
          },
        ],
        extra: {
          image:
            'https://cdn.discordapp.com/attachments/443146683455635466/797929903629926430/Alma_4.jpg',
        },
      },
    ];

    dTree.init(treeData, {
      target: '#graph',
      debug: true,
      height: 800,
      width: 1200,
      callbacks: {
        nodeClick: function (name, extra) {
          console.log(name, extra);
        },
        textRenderer: function (name, extra, textClass) {
          // THis callback is optinal but can be used to customize
          // how the text is rendered without having to rewrite the entire node
          // from screatch.
          if (extra && extra.nickname)
            name = name + ' (' + extra.nickname + ')';
          var content = "<p align='center' class='" + textClass + "'>";
          if (extra && extra.image)
            content += '<img src="' + extra.image + '" class="avatar"/>';
          return content + name + '</p>';
        },
        nodeRenderer: function (
          name,
          x,
          y,
          height,
          width,
          extra,
          id,
          nodeClass,
          textClass,
          textRenderer
        ) {
          // This callback is optional but can be used to customize the
          // node element using HTML.
          let node = '';
          node += '<div ';
          node += 'style="height:100%;width:100%;" ';
          node += 'class="' + nodeClass + '" ';
          node += 'id="node' + id + '">\n';
          node += textRenderer(name, extra, textClass);
          node += '</div>';
          return node;
        },
      },
    });
  },
};

export default GenealogyComponent;
