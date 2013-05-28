desc "Start the PHP Server"
task :server do 
    system('php -S localhost:9292')
end

desc "Run unit tests"
task :units do
    puts "Running all Unit tests through Codeception"
    run_tests()
end

task :acceptance do
    puts "Running all Accpetance tests through Codeception"
    run_tests("acceptance")
end

desc "Deploys the website after running tests and clean ups"
task :deploy do
  puts "--> Running all system tests before deployment..."
  result = run_tests("all")
  if result
    puts "--> All Tests successfully passed"
    puts "--> Initiating PHP clean up..."
    system("php-cs-fixer fix . -fixers=linefeed,short_tag,indentation,trailing_spaces,unused_use,phpdoc_params,visibility,return,braces,extra_empty_lines,elseif,php_closing_tag")
    puts "--> PHP all cleaned up - pushing up to GitHub"
    lazy_git("master")
    puts "--> Uploading files to production server"
    #system('ant upload_files')
    puts "--> Deployment completed."
    growl_notify("Deployment complete and successful!", "")
  end
end

desc "A lazy push task"
task :push do
  lazy_git('master')
end

def lazy_git(branch="development")
  system('git add .')
  system('git add -A')
  system("git commit -m 'Deloyment - updating with master branch'")
  system("git push origin #{branch}")
end

def run_tests(type="unit")
    if type == 'all'
        type = ""
    end
    result = system("php codecept.phar run #{type}")
    type = type.capitalize
    if result
        message = "#{type} Tests Passed!"
        image = ""
    else
        message = "#{type} Tests Failed!"
        image = ""
    end
    growl_notify(message, image)
    return result
end

def growl_notify(message, image="") 
    if !image.nil?
        image = "--image '#{image}'"
    end
    system("growlnotify #{image} -m '#{message}'")
end