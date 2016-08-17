@outputSchema('vals: {(val:map[])}')
def foo(the_input):
    # This converts the indeterminate number of maps into a bag.
    foo = [chr(i) for i in the_input]
    foo = ''.join(foo).strip('()')
    out = []
    for f in foo.split('],['):
        f = f.strip('[]')
        out.append(dict((k, v) for k, v in [ i.split('#') for i in f.split(',')]))
    return out