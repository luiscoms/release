# Contributing to Release

## Development workflow with Git

### Fork, Branching, Commits, and Pull Request

1. [Fork a repo](http://help.github.com/fork-a-repo/) **luiscoms/release**.

2. Clone the **release** project to your local machine (**username** - your Github user account name.):
```
$ git clone git@github.com:USERNAME/release.git
```
3. Configure remotes:
```
$ cd release
$ git remote add upstream git@github.com:luiscoms/release.git
```
4. Create a branch for new check:
```
$ git checkout -b my-new-check
```
5. Develop on **my-new-check** branch only, but **Do not merge my-new-check branch to the your master (as it should stay equal to upstream master)!!**

6. Commit changes to **my-new-check** branch:
```
$ git add .
$ git commit -m "commit message"
```
7. Push branch to GitHub, to allow your mentor to review your code:
```
$ git push origin my-new-check
```
8. Repeat steps 5-7 till development is complete.

9. Fetch upstream changes that were done by other contributors:
```
$ git fetch upstream
```
10. Update local master:
```
$ git checkout master
$ git pull upstream master
```

ATTENTION: any time you lost of track of your code - launch "gitk --all" in source folder, UI application come up that will show all branches and history in pretty view, [explanation](http://lostechies.com/joshuaflanagan/2010/09/03/use-gitk-to-understand-git/).

11. Rebase **my-new-check** branch on top of the upstream master:
```
$ git checkout my-new-check
$ git rebase master
```
12. In the process of the **rebase**, it may discover conflicts. In that case it will stop and allow you to fix the conflicts. After fixing conflicts, use **git add .** to update the index with those contents, and then just run:
```
$ git rebase --continue
```
13. Push branch to GitHub (with all your final changes and actual code of project):
We forcing changes to your issue branch(our sand box) is not common branch, and rebasing means recreation of commits so no way to push without force. NEVER force to common branch.
```
$ git push origin my-new-check --force
```

14. Created build for testing and send it to any mentor for testing.

15. Only after all testing is done - Send a [Pull Request](http://help.github.com/send-pull-requests/).
Attention: Please recheck that in your pull request you send only your changes, and no other changes!!
Check it by command:
```
git diff my-new-check upstream/master
```
More detailed information you can find on [Git-Workflow](https://github.com/diaspora/diaspora/wiki/Git-Workflow), [Git-rebase (Manual Page)](http://kernel.org/pub/software/scm/git/docs/git-rebase.html) and [Rebasing](http://git-scm.com/book/en/v2/Git-Branching-Rebasing).

## Running tests

Install dependencies
```
$ composer install
```

Run tests!
```
./vendor/bin/phpunit -c tests/phpunit.xml    
```
