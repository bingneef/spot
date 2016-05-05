module.exports = function (shipit) {
  require('shipit-deploy')(shipit);
  require('shipit-npm')(shipit);

  shipit.initConfig({
    default: {
      workspace: 'tmp',
      repositoryUrl: 'git@github.com:bingneef/spot.git',
      deployTo: '/var/www/spot/',
      dirToCopy: '',
      ignores: ['.git', 'node_modules'],
      keepReleases: 10,
      deleteOnRollback: false,
      shallowClone: false,
      npm: {
        remote: false
      },
      bower: {
        remote: false
      }
    },
    production: {
      servers: 'bing@5.157.85.46',
      branch: 'master',
      environment: 'production'
    }
  });

  shipit.blTask('gulp:build', function() {
    return shipit.local('cp php/dbinfo.inc.php ' + shipit.config.workspace + '/php/dbinfo.inc.php')
  });

  shipit.on('fetched', function() {
    return shipit.start('gulp:build');
  });
};
