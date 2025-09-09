groups-forums-templates
=======================

Theme template examples for the <a href="http://www.itthinx.com/plugins/groups-forums/">Groups Forums</a> WordPress plugin.

This repository gathers theme-specific templates for the legacy templates in Groups Forums.

Themes
------

Groups Forums integrates automatically with the active theme.

It does not impose a specific look on forums, instead it uses the active theme to represent forums and topics, just like normal categories and posts are displayed.

If you would like to adjust the way things are displayed, you can use WordPress’ template system to customize how forums and topics are rendered.

Theme-specific legacy templates
-------------------------------

In your active theme, add a groups-forums folder. You can provide template files in that folder for the type of page you want to customize, for example:

`single-topic.php` used to display a topic
`taxonomy-forum.php` used to display the topics in a forum

`taxonomy-forum-support.php` to target a specific forum, here for example the Support forum with the support slug
`archive-topic.php` for other forum archives.

Default templates, which can also be used to derive your own, are provided in the plugin’s templates folder.
Included are a `single-topic.php` and a `taxonomy-forum.php` template.

Creating theme-specific legacy templates
----------------------------------------

If you want to create theme-specific templates, you can base it on the examples in the <a href="https://github.com/itthinx/groups-forums-templates">Groups Forums Templates</a> repository on GitHub or the templates that are included in the plugin's <code>templates</code>code> directory.
