# sapphire-mcq-manager



## Getting started

To make it easy for you to get started with GitLab, here's a list of recommended next steps.

Already a pro? Just edit this README.md and make it your own. Want to make it easy? [Use the template at the bottom](#editing-this-readme)!

## Add your files

- [ ] [Create](https://docs.gitlab.com/ee/user/project/repository/web_editor.html#create-a-file) or [upload](https://docs.gitlab.com/ee/user/project/repository/web_editor.html#upload-a-file) files
- [ ] [Add files using the command line](https://docs.gitlab.com/ee/gitlab-basics/add-file.html#add-a-file-using-the-command-line) or push an existing Git repository with the following command:

```
cd existing_repo
git remote add origin https://gitlab.com/sapphire9594637/sapphire-mcq.git
git branch -M main
git push -uf origin main
```

## Integrate with your tools

- [ ] [Set up project integrations](https://gitlab.com/sapphire9594637/sapphire-mcq/-/settings/integrations)

## Collaborate with your team

- [ ] [Invite team members and collaborators](https://docs.gitlab.com/ee/user/project/members/)
- [ ] [Create a new merge request](https://docs.gitlab.com/ee/user/project/merge_requests/creating_merge_requests.html)
- [ ] [Automatically close issues from merge requests](https://docs.gitlab.com/ee/user/project/issues/managing_issues.html#closing-issues-automatically)
- [ ] [Enable merge request approvals](https://docs.gitlab.com/ee/user/project/merge_requests/approvals/)
- [ ] [Set auto-merge](https://docs.gitlab.com/ee/user/project/merge_requests/merge_when_pipeline_succeeds.html)

## Test and Deploy

Use the built-in continuous integration in GitLab.

- [ ] [Get started with GitLab CI/CD](https://docs.gitlab.com/ee/ci/quick_start/index.html)
- [ ] [Analyze your code for known vulnerabilities with Static Application Security Testing(SAST)](https://docs.gitlab.com/ee/user/application_security/sast/)
- [ ] [Deploy to Kubernetes, Amazon EC2, or Amazon ECS using Auto Deploy](https://docs.gitlab.com/ee/topics/autodevops/requirements.html)
- [ ] [Use pull-based deployments for improved Kubernetes management](https://docs.gitlab.com/ee/user/clusters/agent/)
- [ ] [Set up protected environments](https://docs.gitlab.com/ee/ci/environments/protected_environments.html)

***

=== Sapphire MCQ Manager ===
Contributors: sapphireit, bayejid00
Tags: A Multiple Choice Question plugin for education purposes. It’s small in size and very easy to use.
Requires at least: 5.0
Tested up to: 6.3
Requires PHP: 5.3
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.txt


== Description ==
Sapphire MCQ Manager plugin allows to creation of Multiple Choice Questions with or without category. Then show it by copying and pasting the shortcode. It also gives fully customizable options like how many questions per page / Button color / Small Note. The Sapphire Scroll Top plugin has the following features.

### Features
* Small size.
* Can add a small note.
* Button Color Selection.
* Question per page Selection.
* Category / without category-wise selection.
* Async JavaScript.


== Installation ==

1. Click Plugins/Add New from the WordPress admin panel.
1. Search for "Sapphire MCQ Manager" and install.

-or-

1. Download the .zip package.
1. Unzip into the subdirectory 'sapphire-mcq-manager' within your local WordPress plugins directory.
1. Refresh the plugin page and activate the plugin.
1. Configure the plugin using *Sapphire MCQ Manager* in the dashboard menu.

== Frequently Asked Questions ==
 

== Shortcode Example == 
1. Show All multiple-choice questions - 
[sapphire-mcq]

2. Show a specific category question (e. g. common) -
[sapphire-mcq category="common"] or [sapphire-mcq offset=5 category="math", "common"]

3. Want a specific number of questions per page? - copy this code and change the number -
[sapphire-mcq offset=5]

4. Change the button color to your theme -
[sapphire-mcq btn_color="light blue"] or [sapphire-mcq btn_color="#ADD8E6"]

5. Want to change buttons Text Color - 
[sapphire-mcq text_color="#ADD8E6"] or [sapphire-mcq text_color="white"]
